<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\PointsBank;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class PointsBankController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new PointsBank(), function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');
            
            $grid->id->sortable();

            $grid->title;

            $grid->icon->image('', 40);

            $grid->money->help('每1万积分');

            $grid->pip;
            $grid->sort->label()->sortable();
            $grid->status->bool();
            $grid->recommand->bool();

            $grid->ligheight->display(function($text) {
                return implode(" | ", json_decode($text, true));
            });

            $grid->select_type;
            $grid->created_at;
            $grid->updated_at->sortable();
        
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
        return Show::make($id, new PointsBank(), function (Show $show) {

            $show->title;
            $show->icon->image();
            $show->money;
            $show->pip;
            $show->sort;
            $show->status;
            $show->recommand->using([0 => '正常', 1=> '推荐']);
            $show->ligheight->as(function ($text) {
                return implode(" | ", json_decode($text, true));
            });
            $show->select_type;
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
        return Form::make(new PointsBank(), function (Form $form) {

            $form->text('title');

            $form->image('icon')->uniqueName()->help('银行的icon图标');

            $form->currency('money')->symbol('￥')->required()->help('每1万积分的价值,仅作参考');

            $form->select('pip')->options(['自主兑换'=> '自主兑换', '客服介入'=> '客服介入'])->required()->help('兑换积分的方式');

            $form->number('sort')->default(0)->help('排序权重,数字越大越在前');

            $form->switch('status')->default(1)->help('当前的信息是否有效');

            $form->switch('recommand')->default(0)->help('是否推荐产品');

            $form->checkbox('ligheight', '亮点优势')
                ->options(['秒审' => '秒审', '价值高' => '价值高', '安全快捷' => '安全快捷', '审核返款' =>'审核返款', '审核快捷' =>'审核快捷'])
                ->saving(function ($value) { return json_encode($value); });

            $form->text('select_type')->help('积分查询方式');
        
            $form->display('created_at');

            $form->display('updated_at');

            $form->tools(function (Form\Tools $tools) {
                // 去掉删除按钮
                $tools->disableDelete();
            });
        });
    }
}
