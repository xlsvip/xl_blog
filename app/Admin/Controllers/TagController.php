<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\SendEmail;
use App\Admin\Repositories\Tag;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;

class TagController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Tag(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('created_at');
            $grid->actions(function (\Dcat\Admin\Grid\Displayers\Actions $actions) {
                $actions->disableDelete(false);
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Tag(), function (Form $form) {
            $form->text('name');
        });
    }
}
