<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Admin\Repositories\MerchantsImport;
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
        return Grid::make(new MerchantsImport(['mccs']), function (Grid $grid) {

            $grid->id->sortable();
            
            $grid->order_no;

            $grid->merchant_name;
            
            $grid->mobile;

            $grid->column('mccs.explain', 'MCC');

            //$grid->merchant_name_attr;
            //
            //$grid->merchant_prop;
            //$grid->merchant_city;
            //$grid->merchant_county;
            //$grid->merchant_address;
            //$grid->merchant_tel;
            //$grid->reg_no;
            //$grid->reg_expd;
            //$grid->card_no;
            //$grid->card_name;
            //$grid->card_expd;
            //$grid->bank_link;
            //$grid->bank_no;
            //$grid->bank_name;
            
            //$grid->debit_fee;
            //$grid->debit_fee_limit;
            //$grid->credit_fee;
            //$grid->d0_fee;
            //$grid->d0_fee_quota;
            //$grid->union_credit_fee;
            //$grid->union_debit_fee;
            //$grid->ali_fee;
            //$grid->wx_fee;
            //$grid->out_mercid;
            //$grid->sett_type;
            //$grid->pic_xy;
            //$grid->pic_zz;
            //$grid->pic_yhk;
            //$grid->pic_sfz1;
            //$grid->pic_sfz2;
            //$grid->pic_jj;
            //$grid->pic_mt;
            //$grid->pic_nj;
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

            $show->row(function (Show\Row $show) {
                $show->width(6)->order_no;
                $show->width(6)->merchant_name;
                $show->width(6)->mobile;
                $show->width(6)->merchant_name_attr;
                $show->width(6)->merchant_mcc;
                $show->width(6)->merchant_tel;
                $show->width(6)->merchant_prop;
                $show->width(6)->merchant_city;
                $show->width(6)->merchant_county;
                $show->width(6)->merchant_address;

                $show->width(6)->reg_no;
                $show->width(6)->reg_expd;
                $show->width(6)->card_no;
                $show->width(6)->card_name;


                $show->card_expd;
                $show->bank_link;
                $show->bank_no;
                $show->bank_name;
                $show->user_email;




                $show->out_mercid;
                $show->sett_type;

                $show->created_at;
                $show->updated_at;
            });

            

            $show->row(function (Show\Row $show) {
                $show->newline('111');
                $show->width(6)->debit_fee;
                $show->width(6)->debit_fee_limit;
                $show->width(6)->credit_fee;
                $show->width(6)->d0_fee;
                $show->width(6)->d0_fee_quota;
                $show->width(6)->union_credit_fee;
                $show->width(6)->union_debit_fee;
                $show->width(6)->ali_fee;
                $show->width(6)->wx_fee;
            });

            $show->row(function (Show\Row $show) {
                $show->width(6)->pic_xy->image();
                $show->width(6)->pic_zz->image();
                $show->width(6)->pic_yhk->image();
                $show->width(6)->pic_sfz1->image();
                $show->width(6)->pic_sfz2->image();
                $show->width(6)->pic_jj->image();
                $show->width(6)->pic_mt->image();
                $show->width(6)->pic_nj->image();
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
