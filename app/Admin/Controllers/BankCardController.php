<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\BankCard;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class BankCardController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new BankCard(), function (Grid $grid) {

            $grid->id->sortable();

            $grid->title->help('测试这个功能');

            $grid->icon->image('', 40);

            $grid->card_images->image('', 60);

            $grid->money;

            $grid->pip->using([1 => '下卡', 2 => '下卡并首刷', 3=> '其他'])->dot([1 =>'primary',2 =>'danger',3 =>'success' ],'primary');

            $grid->ligheight->display(function($text) {
                return implode(" | ", json_decode($text, true));
            });

            $grid->sort->sortable();

            $grid->recommand->bool();

            $grid->status->bool();

            $grid->apply_url->link();
            //$grid->content;
            $grid->created_at;

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
        return Show::make($id, new BankCard(), function (Show $show) {

            $show->id;

            $show->title;

            $show->icon->image();

            $show->card_images->image();

            $show->money->label();

            $show->pip->using([1 => '下卡', 2 => '下卡并首刷', 3=> '其他'])->dot([1 =>'primary',2 =>'danger',3 =>'success' ],'primary');

            $show->status->using([0 => '关闭', 1 => '开启'])->dot([1 =>'primary', 0 =>'danger'],'primary');

            $show->sort;

            $show->recommand->using([0 => '正常', 1=> '推荐']);

            $show->ligheight->as(function ($text) {
                return implode(" | ", json_decode($text, true));
            });

            $show->apply_url->link();

            $show->content;

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
        return Form::make(new BankCard(), function (Form $form) {

            $form->model()->orderBy('id', 'desc');
            
            $form->display('id');

            $form->text('title')->required()->help('申请办卡的银行或者卡标题');

            $form->image('icon')->disk('applyCards')->uniqueName()->help('银行的icon图标');

            $form->image('card_images')->disk('applyCards')->uniqueName()->help('展示在列表页面的图片');

            $form->currency('money')->symbol('￥')->required()->help('下卡达到标准后奖励的金额');

            $form->select('pip')->options([1=> '下卡', 2=> '下卡并首刷', 3=>'其他'])->required()->help('奖励核发标准');

            $form->checkbox('ligheight', '卡片亮点')
                ->options(['积分价值高' => '积分价值高', '刷卡享5折优惠' => '刷卡享5折优惠', '网购笔笔积分' => '网购笔笔积分', '通过率高' =>'通过率高',
                    '额度大' =>'额度大', '下卡快' =>'下卡快', '权益多' =>'权益多', '免年费' =>'免年费',
                ])
                ->saving(function ($value) {
                    return json_encode($value);
                });

            $form->number('sort')->default(0)->help('排序权重,数字越大越在前');

            $form->switch('recommand')->default(0)->help('是否推荐当前卡种');

            $form->switch('status')->default(1)->help('当前的信息是否有效');

            $form->url('apply_url')->help('银行的申请链接地址')->required();

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
