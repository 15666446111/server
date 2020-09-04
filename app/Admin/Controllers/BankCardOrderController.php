<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\BankCard;
use App\Admin\Repositories\BankCardOrder;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use App\Admin\Extensions\BankCardOrderExpoter;

class BankCardOrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new BankCardOrder(['cards']), function (Grid $grid) {
            
            $grid->id->sortable();
            $grid->order_no->help('申请订单编号,唯一标识');
            $grid->column('cards.title', '标题');
            $grid->name;
            $grid->phone;
            $grid->idcard;
            $grid->order_title;
            $grid->order_money;
            //$grid->column('cards.getpip()', '标题');
            //$grid->cards.getpip;
            //$grid->order_pic;
            $grid->status;
            $grid->pay_money;
            $grid->verfity_time;
            $grid->order_remark;
            //$grid->notify_url;
            //$grid->notify_answ;
            //$grid->ident;
            $grid->merchant;

            $grid->created_at->sortable();

            //$grid->updated_at->sortable();
            
            $grid->disableCreateButton();
            $grid->disableDeleteButton();
            $grid->disableBatchDelete();

            $grid->filter(function (Grid\Filter $filter) {

                $filter->like('order_no');

                $filter->equal('card_id')->select(\App\BankCard::pluck('title', 'id')->toArray());

                $filter->like('name');

                $filter->like('phone');

                $filter->like('idcard');

                $filter->equal('status')->select([0=>'待审核', 1=>'申请成功', -1=>'申请失败', 2=>'订单异常']);

            });

            //$grid->fixColumns(2, -2);

            $grid->paginate(15);

            $titles = ['id' => 'ID', 'order_no' => '订单号', 'name' => '申请人', 'phone'=>'手机号', 'idcard' => '身份证号', 'cards' => '申请卡'];

            $grid->export($titles)->csv();

            //$grid->export(new BankCardOrderExpoter());
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
        return Show::make($id, new BankCardOrder(), function (Show $show) {
            $show->id;
            $show->order_no;
            $show->card_id;
            $show->name;
            $show->phone;
            $show->idcard;
            $show->order_title;
            $show->order_money;
            $show->order_pip;
            $show->order_pic;
            $show->status;
            $show->pay_money;
            $show->verfity_time;
            $show->order_remark;
            $show->notify_url;
            $show->notify_count;
            $show->notify_answ;
            $show->ident;
            $show->merchant;
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
        return Form::make(new BankCardOrder(), function (Form $form) {

            $form->column(6, function (Form $form) {

                $form->display('order_no');

                $form->display('card_id');

                $form->display('ident');

                $form->display('merchant');

                $form->select('status')->options([0=>'待审核', 1=>'申请成功', -1=>'申请失败', 2=>'订单异常'])->required();
                
                $form->currency('pay_money')->symbol('￥')->required();

                $form->display('verfity_time');

                $form->text('order_remark');

            });


            $form->column(6, function (Form $form) {

                $form->display('name');

                $form->display('phone');

                $form->display('idcard');

                $form->display('order_title');

                $form->display('order_money');

                $form->display('order_pip');

                $form->display('order_pic');

                $form->display('notify_url');

                $form->display('notify_count');

                $form->display('notify_answ');

                $form->display('created_at', '申请时间');

            });
            
        });
    }
}
