<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CodeOrder;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class CodeOrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CodeOrder(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('order_no');
            $grid->column('no');
            $grid->column('dy_no');
            $grid->column('out_mercid');
            $grid->column('merchant_number');
            $grid->column('term_no');
            $grid->column('money');
            $grid->column('type');
            $grid->column('code_url');
            //$grid->column('call_url');
            $grid->column('state');
            //$grid->column('call_count');
            //$grid->column('call_answer');
            //$grid->column('dy_return');
            $grid->column('created_at');
            //$grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                //$actions->disableView();
            });
            $grid->disableCreateButton();

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
        return Show::make($id, new CodeOrder(), function (Show $show) {
            $show->field('id');
            $show->field('order_no');
            $show->field('no');
            $show->field('dy_no');
            $show->field('out_mercid');
            $show->field('merchant_number');
            $show->field('term_no');
            $show->field('money');
            $show->field('type');
            $show->field('code_url');
            $show->field('call_url');
            $show->field('state');
            $show->field('call_count');
            $show->field('call_answer');
            $show->field('dy_return');
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
        return Form::make(new CodeOrder(), function (Form $form) {
            $form->display('id');
            $form->text('order_no');
            $form->text('no');
            $form->text('dy_no');
            $form->text('out_mercid');
            $form->text('merchant_number');
            $form->text('term_no');
            $form->text('money');
            $form->text('type');
            $form->text('code_url');
            $form->text('call_url');
            $form->text('state');
            $form->text('call_count');
            $form->text('call_answer');
            $form->text('dy_return');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
