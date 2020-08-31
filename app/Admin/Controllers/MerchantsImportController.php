<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\MerchantsImport;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class MerchantsImportController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MerchantsImport(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->order_no;
            $grid->mobile;
            $grid->merchant_name;
            $grid->merchant_name_attr;
            $grid->merchant_mcc;
            $grid->merchant_prop;
            $grid->merchant_city;
            $grid->merchant_county;
            $grid->merchant_address;
            $grid->merchant_tel;
            $grid->reg_no;
            $grid->reg_expd;
            $grid->card_no;
            $grid->card_name;
            $grid->card_expd;
            $grid->bank_link;
            $grid->bank_no;
            $grid->bank_name;
            $grid->user_email;
            $grid->debit_fee;
            $grid->debit_fee_limit;
            $grid->credit_fee;
            $grid->d0_fee;
            $grid->d0_fee_quota;
            $grid->union_credit_fee;
            $grid->union_debit_fee;
            $grid->ali_fee;
            $grid->wx_fee;
            $grid->out_mercid;
            $grid->sett_type;
            $grid->pic_xy;
            $grid->pic_zz;
            $grid->pic_yhk;
            $grid->pic_sfz1;
            $grid->pic_sfz2;
            $grid->pic_jj;
            $grid->pic_mt;
            $grid->pic_nj;
            $grid->created_at;
            $grid->updated_at->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
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
        return Show::make($id, new MerchantsImport(), function (Show $show) {
            $show->id;
            $show->order_no;
            $show->mobile;
            $show->merchant_name;
            $show->merchant_name_attr;
            $show->merchant_mcc;
            $show->merchant_prop;
            $show->merchant_city;
            $show->merchant_county;
            $show->merchant_address;
            $show->merchant_tel;
            $show->reg_no;
            $show->reg_expd;
            $show->card_no;
            $show->card_name;
            $show->card_expd;
            $show->bank_link;
            $show->bank_no;
            $show->bank_name;
            $show->user_email;
            $show->debit_fee;
            $show->debit_fee_limit;
            $show->credit_fee;
            $show->d0_fee;
            $show->d0_fee_quota;
            $show->union_credit_fee;
            $show->union_debit_fee;
            $show->ali_fee;
            $show->wx_fee;
            $show->out_mercid;
            $show->sett_type;
            $show->pic_xy;
            $show->pic_zz;
            $show->pic_yhk;
            $show->pic_sfz1;
            $show->pic_sfz2;
            $show->pic_jj;
            $show->pic_mt;
            $show->pic_nj;
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
        return Form::make(new MerchantsImport(), function (Form $form) {
            $form->display('id');
            $form->text('order_no');
            $form->text('mobile');
            $form->text('merchant_name');
            $form->text('merchant_name_attr');
            $form->text('merchant_mcc');
            $form->text('merchant_prop');
            $form->text('merchant_city');
            $form->text('merchant_county');
            $form->text('merchant_address');
            $form->text('merchant_tel');
            $form->text('reg_no');
            $form->text('reg_expd');
            $form->text('card_no');
            $form->text('card_name');
            $form->text('card_expd');
            $form->text('bank_link');
            $form->text('bank_no');
            $form->text('bank_name');
            $form->text('user_email');
            $form->text('debit_fee');
            $form->text('debit_fee_limit');
            $form->text('credit_fee');
            $form->text('d0_fee');
            $form->text('d0_fee_quota');
            $form->text('union_credit_fee');
            $form->text('union_debit_fee');
            $form->text('ali_fee');
            $form->text('wx_fee');
            $form->text('out_mercid');
            $form->text('sett_type');
            $form->text('pic_xy');
            $form->text('pic_zz');
            $form->text('pic_yhk');
            $form->text('pic_sfz1');
            $form->text('pic_sfz2');
            $form->text('pic_jj');
            $form->text('pic_mt');
            $form->text('pic_nj');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
