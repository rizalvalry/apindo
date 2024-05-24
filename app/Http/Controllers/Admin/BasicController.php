<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload;
use App\Models\Configure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Image;
use Session;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;

class BasicController extends Controller
{
    use Upload;

    public function index(Request $request)
    {
        $timeZone = timezone_identifiers_list();
        $control = Configure::firstOrNew();
        $control->time_zone_all = $timeZone;
        return view('admin.basic-controls', compact('control'));
    }



    public function updateConfigure(Request $request)
    {
        $configure = Configure::firstOrNew();
        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'site_title' => 'required',
            'base_color' => 'required',
            'time_zone' => 'required',
            'currency' => 'required',
            'currency_symbol' => 'required',
            'fraction_number' => 'required|integer',
            'paginate' => 'required|integer'
        ]);

        config(['basic.site_title' => $reqData['site_title']]);
        config(['basic.base_color' => $reqData['base_color']]);
        config(['basic.time_zone' => $reqData['time_zone']]);
        config(['basic.currency' => $reqData['currency']]);
        config(['basic.currency_symbol' => $reqData['currency_symbol']]);
        config(['basic.fraction_number' => (int)$reqData['fraction_number']]);
        config(['basic.paginate' => (int)$reqData['paginate']]);

        config(['basic.error_log' => (int)$reqData['error_log']]);
        config(['basic.strong_password' => (int) $reqData['strong_password']]);
        config(['basic.registration' => (int) $reqData['registration']]);
        config(['basic.is_active_cron_notification' => (int)$reqData['cron_set_up_pop_up']]);
        config(['basic.maintenance_mode' => (int)$reqData['maintenance_mode']]);

        $configure->maintenance_mode = (int) $reqData['maintenance_mode'];
        $configure->fill($reqData)->save();

        $fp = fopen(base_path() . '/config/basic.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('basic'), true) . ';');
        fclose($fp);


        $envPath = base_path('.env');
        $env = file($envPath);
        $env = $this->set('APP_DEBUG', ($configure->error_log == 1) ?'true' : 'false', $env);
        $env = $this->set('APP_TIMZONE', '"'.$reqData['time_zone'].'"', $env);

        $fp = fopen($envPath, 'w');
        fwrite($fp, implode($env));
        fclose($fp);

        session()->flash('success', __('Updated Successfully'));
        Artisan::call('optimize:clear');
        return back();
    }

    private function set($key, $value, $env)
    {
        foreach ($env as $env_key => $env_value) {
            $entry = explode("=", $env_value, 2);
            if ($entry[0] == $key) {
                $env[$env_key] = $key . "=" . $value . "\n";
            } else {
                $env[$env_key] = $env_value;
            }
        }
        return $env;
    }


    public function manageTheme()
    {
        $data['configure'] = Configure::firstOrNew();
        $data['theme'] = config('theme');
        return view('admin.manage-theme',$data);
    }

    public function activateTheme(Request $request, $name)
    {
        config(['basic.theme' => $name]);
        $fp = fopen(base_path() . '/config/basic.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('basic'), true) . ';');
        fclose($fp);

        $configure = Configure::firstOrNew();
        $configure->theme = $name;
        $configure->save();

        session()->flash('success', __('Theme Activated Successfully'));
        Artisan::call('optimize:clear');
        return back();
    }

    public function logoSeo()
    {
        $seo = (object) config('seo');
        return view('admin.logo',compact('seo'));
    }

    public function logoUpdate(Request $request)
    {
        if ($request->hasFile('image')) {
            try {
                //$old = 'logo.png';
                $old = config('basic.logo_image');
                $image = $this->fileUpload($request->image, config('location.logo.path'), config('basic.default_file_driver'), $old, $old);
                if ($image) {
                    config(['basic.logo_image' => $image['path']]);
                }
              
            } catch (\Exception $exp) {
                return back()->with('error', __('Logo could not be uploaded.'));
            }
        }

        if ($request->hasFile('admin_logo')) {
            try {
                //$old = 'admin-logo.png';
                $old = config('basic.admin_logo');
                $image = $this->fileUpload($request->admin_logo, config('location.logo.path'), config('basic.default_file_driver'), $old, $old);
                if ($image) {
                    config(['basic.admin_logo' => $image['path']]);
                }
            } catch (\Exception $exp) {
                return back()->with('error', __('Adnub Logo could not be uploaded.'));
            }
        }
        if ($request->hasFile('favicon')) {
            try {
                //$old = 'favicon.png';
              
                $old = config('basic.favicon_image');
              	$image = $this->fileUpload($request->favicon, config('location.logo.path'), config('basic.default_file_driver'), $old, $old);
                if ($image) {
                    config(['basic.favicon_image' => $image['path']]);
                }
            } catch (\Exception $exp) {
              dd($exp);
                return back()->with('error', __('favicon could not be uploaded.'));
            }
        }
      
      	$fp = fopen(base_path() . '/config/basic.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('basic'), true) . ';');
        fclose($fp);


      
        return back()->with('success', __('Logo has been updated.'));
    }


    public function breadcrumb()
    {
        return view('admin.banner');
    }

    public function breadcrumbUpdate(Request $request)
    {
        if ($request->hasFile('banner')) {
            try {
                //$old = 'banner.jpg';
                $old = config('basic.partial_banner');
                $this->fileUpload($request->banner, config('location.logo.path'), config('basic.default_file_driver'), $old, $old);
            } catch (\Exception $exp) {
                return back()->with('error', __('Banner could not be uploaded.'));
            }
        }
        return back()->with('success', __('Banner has been updated.'));
    }


    public function seoUpdate(Request $request)
    {

        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'social_title' => 'required',
            'social_description' => 'required'
        ]);
        config(['seo.meta_keywords' => $reqData['meta_keywords']]);
        config(['seo.meta_description' => $request['meta_description']]);
        config(['seo.social_title' => $reqData['social_title']]);
        config(['seo.social_description' => $reqData['social_description']]);


        if ($request->hasFile('meta_image')) {
            try {
                $old = config('seo.meta_image');
                $image = $this->fileUpload($request->meta_image, config('location.logo.path'), config('basic.default_file_driver'), $old, $old);
                if ($image) {
                    config(['seo.meta_image' => $image['path']]);
                }
            } catch (\Exception $exp) {
                return back()->with('error', __('Meta image could not be uploaded.'));
            }
        }

        $fp = fopen(base_path() . '/config/seo.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('seo'), true) . ';');
        fclose($fp);
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return back()->with('success', __('Favicon has been updated.'));

    }

    public function pluginConfig()
    {
        $control = Configure::firstOrNew();
        return view('admin.plugin_panel.pluginConfig', compact('control'));
    }

    public function tawkConfig(Request $request)
    {
        $basicControl = basicControl();
        if ($request->isMethod('get')) {
            return view('admin.plugin_panel.tawkControl', compact('basicControl'));
        } elseif ($request->isMethod('post')) {
            $purifiedData = Purify::clean($request->all());

            $validator = Validator::make($purifiedData, [
                'tawk_id' => 'required|min:3',
                'tawk_status' => 'nullable|integer|min:0|in:0,1',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $purifiedData = (object)$purifiedData;

            $basicControl->tawk_id = $purifiedData->tawk_id;
            $basicControl->tawk_status = $purifiedData->tawk_status;
            $basicControl->save();

            return back()->with('success', 'Successfully Updated');
        }
    }

    public function fbMessengerConfig(Request $request)
    {
        $basicControl = basicControl();

        if ($request->isMethod('get')) {
            return view('admin.plugin_panel.fbMessengerControl', compact('basicControl'));
        } elseif ($request->isMethod('post')) {
            $purifiedData = Purify::clean($request->all());

            $validator = Validator::make($purifiedData, [
                'fb_messenger_status' => 'nullable|integer|min:0|in:0,1',
                'fb_app_id' => 'required|min:3',
                'fb_page_id' => 'required|min:3',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $purifiedData = (object)$purifiedData;

            $basicControl->fb_app_id = $purifiedData->fb_app_id;
            $basicControl->fb_page_id = $purifiedData->fb_page_id;
            $basicControl->fb_messenger_status = $purifiedData->fb_messenger_status;

            $basicControl->save();

            return back()->with('success', 'Successfully Updated');
        }
    }

    public function googleRecaptchaConfig(Request $request)
    {
        $basicControl = basicControl();

        if ($request->isMethod('get')) {
            return view('admin.plugin_panel.googleReCaptchaControl', compact('basicControl'));
        } elseif ($request->isMethod('post')) {
            $purifiedData = Purify::clean($request->all());

            $validator = Validator::make($purifiedData, [
                'reCaptcha_status_login' => 'nullable|integer|min:0|in:0,1',
                'reCaptcha_status_registration' => 'nullable|integer|min:0|in:0,1',
                'NOCAPTCHA_SECRET' => 'required|min:3',
                'NOCAPTCHA_SITEKEY' => 'required|min:3',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $purifiedData = (object)$purifiedData;

            $basicControl->reCaptcha_status_login = $purifiedData->reCaptcha_status_login;
            $basicControl->reCaptcha_status_registration = $purifiedData->reCaptcha_status_registration;
            $basicControl->save();


            $envPath = base_path('.env');
            $env = file($envPath);
            $env = $this->set('NOCAPTCHA_SECRET', $purifiedData->NOCAPTCHA_SECRET, $env);
            $env = $this->set('NOCAPTCHA_SITEKEY', $purifiedData->NOCAPTCHA_SITEKEY, $env);
            $fp = fopen($envPath, 'w');
            fwrite($fp, implode($env));
            fclose($fp);

            Artisan::call('config:clear');
            Artisan::call('cache:clear');

            return back()->with('success', 'Successfully Updated');
        }
    }

    public function googleAnalyticsConfig(Request $request)
    {
        $basicControl = basicControl();

        if ($request->isMethod('get')) {
            return view('admin.plugin_panel.analyticControl', compact('basicControl'));
        } elseif ($request->isMethod('post')) {
            $purifiedData = Purify::clean($request->all());

            $validator = Validator::make($purifiedData, [
                'MEASUREMENT_ID' => 'required|min:3',
                'analytic_status' => 'nullable|integer|min:0|in:0,1',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $purifiedData = (object)$purifiedData;

            $basicControl->MEASUREMENT_ID = $purifiedData->MEASUREMENT_ID;
            $basicControl->analytic_status = $purifiedData->analytic_status;
            $basicControl->save();

            return back()->with('success', 'Successfully Updated');
        }
    }
}
