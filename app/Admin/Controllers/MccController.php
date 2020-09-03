<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Admin\Repositories\Mcc;
use App\Admin\Actions\Grid\Reast;
use Dcat\Admin\Controllers\AdminController;

class MccController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Mcc(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->mcc;
            $grid->explain;
            $grid->type->using([1 => '标准商户', 2 => '小微商户']);
            $grid->created_at;
            $grid->updated_at->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });

            $grid->tools(function (Grid\Tools $tools) {
                $tools->append(new Reast());
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
        return Show::make($id, new Mcc(), function (Show $show) {
            $show->id;
            $show->mcc;
            $show->explain;
            $show->created_at;
            $show->updated_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Mcc(), function (Form $form) {
            $form->display('id');
            $form->text('mcc');
            $form->text('explain');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
