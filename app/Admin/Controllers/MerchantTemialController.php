<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\MerchantTemial;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class MerchantTemialController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MerchantTemial(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('merc_no');
            $grid->column('out_mercid');
            $grid->column('sn');
            $grid->column('term_no');
            $grid->column('dy_term_no');
            $grid->column('term_name');
            $grid->column('term_address');

            $grid->column('state');

            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
            
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->disableView();
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
        return Show::make($id, new MerchantTemial(), function (Show $show) {
            $show->field('id');
            $show->field('merc_no');
            $show->field('sn');
            $show->field('term_no');
            $show->field('dy_term_no');
            $show->field('term_name');
            $show->field('term_address');
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
        return Form::make(new MerchantTemial(), function (Form $form) {
            $form->display('id');
            $form->text('merc_no');
            $form->text('sn');
            $form->text('term_no');
            $form->text('dy_term_no');
            $form->text('term_name');
            $form->text('term_address');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
