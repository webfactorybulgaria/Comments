<?php

namespace TypiCMS\Modules\Comments\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Shells\Composers\BaseSidebarViewComposer;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.social'), function (SidebarGroup $group) {
            $group->id = 'social';
            $group->addItem(trans('comments::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.comments.sidebar.icon', 'icon fa fa-fw fa-file-photo-o');
                $item->weight = config('typicms.comments.sidebar.weight');
                $item->route('admin::index-comments');
                $item->append('admin::create-file');
                $item->authorize(
                    Gate::allows('index-comments')
                );
            });
        });
    }
}
