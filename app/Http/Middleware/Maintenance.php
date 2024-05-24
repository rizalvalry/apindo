<?php

namespace App\Http\Middleware;

use App\Models\ContentDetails;
use App\Models\Template;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Maintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->theme = template();
        $basic = (object)config('basic');

        if ($basic->maintenance_mode == 1){
            $templateSection = ['maintenance-page'];
            $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
            $contentSection = ['social'];
            $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
                ->whereHas('content', function ($query) use ($contentSection) {
                    return $query->whereIn('name', $contentSection);
                })
                ->with(['content:id,name',
                    'content.contentMedia' => function ($q) {
                        $q->select(['content_id', 'description']);
                    }])
                ->get()->groupBy('content.name');
            return new response(view($this->theme.'site.maintenance', $data));
        }

        return $next($request);
    }
}
