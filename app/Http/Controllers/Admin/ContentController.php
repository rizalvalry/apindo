<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogCategoryDetails;
use App\Models\BlogDetails;
use App\Models\Content;
use App\Models\ContentDetails;
use App\Models\ContentMedia;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;


class ContentController extends Controller
{
    use Upload;

    public function index($content)
    {
        if (!array_key_exists($content, config('contents'))) {
            abort(404);
        }
        $contents = Content::with('contentDetails', 'contentMedia')->where('name', $content)->get();
        return view('admin.content.index', compact('content', 'contents'));
    }

    public function create($content)
    {
        if (!array_key_exists($content, config('contents'))) {
            abort(404);
        }
        $languages = Language::all();

        return view('admin.content.create', compact('languages', 'content'));
    }

    public function store(Request $request, $content, $language)
    {
        if (!array_key_exists($content, config('contents'))) {
            abort(404);
        }

        $purifiedData = Purify::clean($request->except('image', 'thumbnail', '_token', '_method'));

        if ($request->has('image')) {
            $purifiedData['image'] = $request->image;
        }
        if ($request->has('thumbnail')) {
            $purifiedData['thumbnail'] = $request->thumbnail;
        }

        $validate = Validator::make($purifiedData, config("contents.$content.validation"), config('contents.message'));

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $field_name = array_diff_key(config("contents.$content.field_name"), config("contents.content_media"));

        foreach ($field_name as $name => $type) {
            $description[$name] = $purifiedData[$name][$language];
        }

        $contentModel = new Content();
        $contentModel->name = $content;
        $contentModel->save();

        if ($language != 0) {
            $contentDetails = new ContentDetails();
            $contentDetails->content_id = $contentModel->id;
            $contentDetails->language_id = $language;
            $contentDetails->description = $description ?: null;
            $contentDetails->save();
        }

        if ($request->hasAny(array_keys(config('contents.content_media')))) {
            $contentMedia = new ContentMedia();

            foreach (config('contents.content_media') as $key => $media) {
                if ($request->hasFile($key)) {
                    $size = null;
                    $thumb = null;
                    if (config("contents.$content.size.image")) {
                        $size = config("contents.$content.size.image");
                    }
                    if (config("contents.$content.size.thumb")) {
                        $thumb = config("contents.$content.size.thumb");
                    }

                    $image = $this->fileUpload($purifiedData[$key][$language], config('location.content.path'));

                    if ($image) {
                        $contentMediaDescription[$key] = $image['path'];
                        $contentMedia->driver = $image['driver'];
                    }

                } elseif ($request->has($key)) {
                    $contentMediaDescription[$key] = linkToEmbed($purifiedData[$key][$language]);
                }
            }

            $contentMedia->content_id = $contentModel->id;
            $contentMedia->description = $contentMediaDescription ?? null;
            $contentMedia->save();
        }

        return redirect(route('admin.content.index', $content))->with('success', 'Content Details Successfully Saved');
    }

    public function show(Content $content, $name = null)
    {
        if (!array_key_exists($content->name, config('contents'))) {
            abort(404);
        }

        $languages = Language::all();
        $contentDetails = ContentDetails::where('content_id', $content->id)->get()->groupBy('language_id');
        $contentMedia = ContentMedia::where('content_id', $content->id)->first();

        return view('admin.content.show', compact('content', 'languages', 'contentDetails', 'contentMedia'));
    }

    public function update(Request $request, Content $content, $language)
    {
        if (!array_key_exists($content->name, config('contents'))) {
            abort(404);
        }

        $purifiedData = Purify::clean($request->except('image', 'thumbnail', '_token', '_method'));

        if ($request->has('image')) {
            $purifiedData['image'] = $request->image;
        }
        if ($request->has('thumbnail')) {
            $purifiedData['thumbnail'] = $request->thumbnail;
        }

        $validate = Validator::make($purifiedData, config("contents.$content->name.validation"), config('contents.message'));
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $field_name = array_diff_key(config("contents.$content->name.field_name"), config("contents.content_media"));

        foreach ($field_name as $name => $type) {
            $description[$name] = $purifiedData[$name][$language];
        }

        if ($language != 0) {
            $contentDetails = ContentDetails::where(['content_id' => $content->id, 'language_id' => $language])->firstOrNew();
            $contentDetails->content_id = $content->id;
            $contentDetails->language_id = $language;
            $contentDetails->description = $description ?? null;
            $contentDetails->save();
        }

        if ($request->hasAny(array_keys(config('contents.content_media')))) {
            $contentMedia = ContentMedia::where(['content_id' => $content->id])->firstOrNew();

            foreach (config('contents.content_media') as $key => $media) {
                $old_data = optional($contentMedia->description)->{$key} ?? null;
                if ($request->hasFile($key)) {
                    $size = null;
                    $thumb = null;
                    if (config("contents.$content->name.size.image")) {
                        $size = config("contents.$content->name.size.image");
                    }
                    if (config("contents.$content->name.size.thumb")) {
                        $thumb = config("contents.$content->name.size.thumb");
                    }

                    $contentMediaDescription[$key] = $this->uploadImage($purifiedData[$key][$language], config('location.content.path'), $size, $old_data, $thumb);

                    $image = $this->fileUpload($purifiedData[$key][$language], config('location.content.path'), $contentMedia->driver, null, $old_data);

                    if ($image) {
                        $contentMediaDescription[$key] = $image['path'];
                        $contentMedia->driver = $image['driver'];
                    }

                } elseif ($request->has($key)) {
                    $contentMediaDescription[$key] = linkToEmbed($purifiedData[$key][$language]);
                } elseif (isset($old_data)) {
                    $contentMediaDescription[$key] = $old_data;
                }
            }

            $contentMedia->content_id = $content->id;
            $contentMedia->description = $contentMediaDescription ?? null;
            $contentMedia->save();
        }

        return back()->with('success', 'Content Details Successfully Saved');
    }

    public function contentDelete($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
        return back()->with('success', 'Content has been deleted');
    }

    public function categoryList()
    {
        $manageBlogCategory = BlogCategory::with('details')->latest()->get();
        return view('admin.blog.categoryList', compact('manageBlogCategory'));
    }

    public function blogCategoryCreate()
    {
        $languages = Language::all();
        return view('admin.blog.blogCategoryCreate', compact('languages'));
    }

    public function blogCategoryStore(Request $request, $language)
    {

        $purifiedData = Purify::clean($request->except('_token', '_method'));

        $rules = [
            'name.*' => 'required|max:100',
        ];

        $message = [
            'name.*.required' => 'Category name field is required',
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $blogCategory = new BlogCategory();
        $blogCategory->save();

        $blogCategory->details()->create([
            'language_id' => $language,
            'name' => $purifiedData["name"][$language],
        ]);

        return redirect()->route('admin.blogCategory')->with('success', 'Blog Category Successfully Saved');

    }

    public function blogCategoryEdit($id)
    {
        $languages = Language::all();
        $blogCategoryDetails = BlogCategoryDetails::with('category')->where('blog_category_id', $id)->get()->groupBy('language_id');
        return view('admin.blog.blogCategoryEdit', compact('languages', 'blogCategoryDetails', 'id'));
    }

    public function blogCategoryUpdate(Request $request, $id, $language_id)
    {

        $purifiedData = Purify::clean($request->except('_token', '_method'));

        $rules = [
            'name.*' => 'required|max:100',
        ];

        $message = [
            'name.*.required' => 'Category name field is required',
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $blogCategory = BlogCategory::findOrFail($id);
        $blogCategory->save();

        $blogCategory->details()->updateOrCreate([
            'language_id' => $language_id
        ],
            [
                'name' => $purifiedData["name"][$language_id],
            ]
        );

        return redirect()->route('admin.blogCategory')->with('success', 'Blog Category Successfully Updated');
    }

    public function blogCategoryDelete($id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
        $blogCategory->delete();
        return back()->with('success', 'Blog Category has been deleted');
    }

    public function blogList()
    {
        $data['blogs'] = Blog::with('details', 'category.details')->latest()->get();
        return view('admin.blog.blogList', $data);
    }

    public function blogCreate()
    {

        $languages = Language::all();
        $data['blogCategory'] = BlogCategory::with('details')->get();
        return view('admin.blog.blogCreate', $data, compact('languages'));
    }


    public function blogStore(Request $request, $language = null)
    {

        $purifiedData = Purify::clean($request->except('image', '_token', '_method'));

        if ($request->has('image')) {
            $purifiedData['image'] = $request->image;
        }

        $rules = [
            'blog_category_id' => 'required',
            'author.*' => 'required|max:50',
            'title.*' => 'required|max:191',
            'details.*' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ];
        $message = [
            'blog_category_id.required' => 'Please select blog category',
            'author.*.max' => 'This field may not be greater than :max characters',
            'author.*.required' => 'This field is required',
            'title.*.required' => 'This field is required',
            'details.*.required' => 'This field is required',
            'image.required' => 'Image is required'
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $blog = new Blog();

        $blog->blog_category_id = $request->blog_category_id;


        if ($request->hasFile('image')) {
            try {
                $blog->image = $this->uploadImage($purifiedData['image'], config('location.blog.path'), config('location.blog.size'));
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }

        $blog->save();

        $blog->details()->create([

            'language_id' => $language,
            'author' => $purifiedData["author"][$language],
            'title' => $purifiedData["title"][$language],
            'details' => $purifiedData["details"][$language],
        ]);

        return redirect()->route('admin.blogList')->with('success', 'Blog Successfully Saved');
    }


    public function blogEdit($id)
    {
        $languages = Language::all();
        $blogDetails = BlogDetails::with('blog')->where('blog_id', $id)->get()->groupBy('language_id');
        $blogCategory = BlogCategory::with('details')->get();

        return view('admin.blog.blogEdit', compact('languages', 'blogDetails', 'blogCategory', 'id'));
    }


    public function blogUpdate(Request $request, $id, $language_id)
    {
        $purifiedData = Purify::clean($request->except('image', '_token', '_method'));

        if ($request->has('image')) {
            $purifiedData['image'] = $request->image;
        }

        $rules = [
            'blog_category_id' => 'sometimes|required',
            'author.*' => 'required|max:50',
            'title.*' => 'required|max:191',
            'details.*' => 'required',
            'image' => 'sometimes|required|mimes:jpg,jpeg,png'
        ];
        $message = [
            'blog_category_id.required' => 'Please select blog category',
            'author.*.max' => 'This field may not be greater than :max characters',
            'author.*.required' => 'This field is required',
            'title.*.required' => 'This field is required',
            'details.*.required' => 'This field is required',
            'image.required' => 'Image is required'
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $blog = Blog::findOrFail($id);

        if ($request->has('blog_category_id')) {
            $blog->blog_category_id = $request->blog_category_id;
        }


        if ($request->hasFile('image')) {
            try {
                $blog->image = $this->uploadImage($purifiedData['image'], config('location.blog.path'), config('location.blog.size'), $blog->image);
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }

        $blog->save();

        $blog->details()->updateOrCreate([
            'language_id' => $language_id
        ],
            [
                'author' => $purifiedData["author"][$language_id],
                'title' => $purifiedData["title"][$language_id],
                'details' => $purifiedData["details"][$language_id],
            ]
        );

        return redirect()->route('admin.blogList')->with('success', 'Blog Successfully Updated');

    }

    public function blogDelete($id)
    {
        $blog = Blog::findOrFail($id);
        $old_image = $blog->image;
        $location = config('location.blog.path');

        if (!empty($old_image)) {
            unlink($location . '/' . $old_image);
        }

        $blog->delete();
        return back()->with('success', 'Blog has been deleted');
    }
}
