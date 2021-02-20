<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\PointsOrder as PointsOrderM;
use App\Admin\Repositories\PointsOrder;
use Dcat\Admin\Controllers\AdminController;

class PointsOrderController extends AdminController{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $order = PointsOrderM::first();

        //dd($order->products->banks->title);

        return Grid::make(PointsOrderM::with(['products']), function (Grid $grid) {

            //$grid->model()->with(['products.banks']);

            $grid->model()->orderBy('id', 'desc');
            
            $grid->order_no;

            $grid->column('products.title', '产品');

            $grid->column('products.change_type', '方式')->using([0 => '截图报单', 1 => '联系客服'])->dot([0 =>'primary', 1 =>'danger'],'primary');

            $grid->order_money->label();

            $grid->pay_money->label();

            $grid->order_pic->image('', 40);

            $grid->content->copyable();

            $grid->status;

            $grid->order_remark;
            
            $grid->verfity_time->sortable();

            $grid->created_at->sortable();
        
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
        return Show::make($id, new PointsOrder(), function (Show $show) {
            $show->id;
            $show->notify_answ;
            $show->notify_url;
            $show->order_money;
            $show->order_no;
            $show->order_pic;
            $show->order_remark;
            $show->pay_money;
            $show->product_id;
            $show->status;
            $show->verfity_time;
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
        return Form::make(new PointsOrder(), function (Form $form) {

            $form->column(6, function (Form $form) {

                $form->text('order_no')->disable();

                $form->select('product_id')->options(\App\PointProduct::pluck('title', 'id')->toArray())->disable();

                $form->text('order_money')->disable();

                $form->image('order_pic')->disable();

                $form->text('content')->disable();

                $form->select('status')->options([0=>'待审核', 1=>'审核通过', -1=>'审核拒绝'])->disable();

                $form->text('notify_url')->disable();

                $form->text('notify_answ')->disable();

            });
            
            $form->column(6, function (Form $form) {

                $form->text('order_remark');

                $form->currency('pay_money')->symbol('￥')->required();

                $form->text('verfity_time')->disable();

                $form->text('ident')->disable();

                $form->text('merchant')->disable();

                $form->text('created_at')->disable();
                
                $form->text('updated_at')->disable();
            });

            $form->tools(function (Form\Tools $tools) {
                // 去掉删除按钮
                $tools->disableDelete();
            });
        });
    }
}
