<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('email');

            $grid->column('profile_photo_path');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            // 只导出 id, name和email 三列数据
            $titles = ['id' => 'ID', 'name' => '名称', 'email' => '邮箱'];

            $grid->export($titles);

            // 也可以这么使用
            $grid->export()->titles($titles);
            // 显示批量删除按钮
            $grid->showBatchDelete();

            $grid->actions(function (\Dcat\Admin\Grid\Displayers\Actions $actions) {
                $actions->disableDelete(false);
                $actions->disableEdit(false);

            });
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('name');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('email');
            $show->field('email_verified_at');
            $show->field('password');
            $show->field('two_factor_secret');
            $show->field('two_factor_recovery_codes');
            $show->field('remember_token');
            $show->field('profile_photo_path');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('email');
            $form->text('email_verified_at');
            $form->text('password');
            $form->text('two_factor_secret');
            $form->text('two_factor_recovery_codes');
            $form->text('remember_token');
            $form->text('profile_photo_path');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
