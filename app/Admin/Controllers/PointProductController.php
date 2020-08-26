<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\PointProduct;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Admin;
use Dcat\Admin\Controllers\AdminController;

class PointProductController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new PointProduct(['banks']), function (Grid $grid) {

            $grid->id->sortable();
            
            $grid->title;
            
            $grid->column('banks.title', '银行');
            
            $grid->need_points;

            $grid->change_count;

            $grid->change_type->using([0 => '截图报单', 1 => '联系客服'])->dot([0 =>'primary', 1 =>'danger'],'primary');

            $grid->product_money;

            $grid->status->bool();

            $grid->sort->sortable();

            $grid->recommand->bool();

            $grid->demo;

            $grid->created_at->sortable();
            //$grid->updated_at->sortable();
        
            $grid->disableDeleteButton();
            $grid->disableBatchDelete();

            $grid->filter(function (Grid\Filter $filter) {

                $filter->like('title');

                $filter->equal('status')->select([0 => '关闭', 1=>'开启']);

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
        return Show::make($id, new PointProduct(), function (Show $show) {
            $show->id;
            $show->title;
            $show->card_id;
            $show->need_points;
            $show->change_count;
            $show->change_type;
            $show->sort;
            $show->product_money;

            $show->recommand->using([0 => '正常', 1=> '推荐']);

            $show->demo->image();
            $show->created_at;
            $show->updated_at;

            $show->panel()->tools(function ($tools) {
                $tools->disableDelete();
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
        return Form::make(new PointProduct(), function (Form $form) {

            $form->text('title');

            $form->select('card_id')->options(\App\PointsBank::where('status', 1)->pluck('title', 'id')->toArray());

            $form->text('need_points');

            $form->text('change_count');

            $form->select('change_type')->options([0=>'截图报单', 1=>'联系客服']);

            $form->number('sort')->default(0)->help('排序权重,数字越大越在前');

            $form->switch('status')->default(1)->help('当前的信息是否有效');

            $form->switch('recommand')->default(0)->help('是否推荐当前卡种');

            $form->currency('product_money')->symbol('￥')->required()->help('产品的实际回收价格');

            $form->image('demo')->uniqueName()->help('上传报单的示例截图');

            $form->editor('content')->imageDirectory('editor/images');

            $form->display('created_at');

            $form->display('updated_at');

            $form->tools(function (Form\Tools $tools) {
                // 去掉删除按钮
                $tools->disableDelete();
            });
        });
    }
}
