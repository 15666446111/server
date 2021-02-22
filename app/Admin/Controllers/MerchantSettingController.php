<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\MerchantSetting;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Controllers\AdminController;

class MerchantSettingController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MerchantSetting(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->company;
            $grid->people;
            $grid->phone;
            $grid->email;
            $grid->address;
            $grid->merchant_number;
            //$grid->merchant_secret;
            //$grid->merchant_ability;
            //$grid->apply_card_notify_url;
            //$grid->points_change_notify_url;
            //$grid->nocard_pay_notify_url;
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
        return Show::make($id, new MerchantSetting(), function (Show $show) {

            $show->company;
            $show->people;
            $show->phone;
            $show->email;
            $show->address;
            $show->merchant_number;
            $show->merchant_secret;
            $show->merchant_ability;
            $show->apply_card_notify_url;
            $show->points_change_notify_url;
            $show->nocard_pay_notify_url;
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
        return Form::make(new MerchantSetting(), function (Form $form) {
            $form->tab('基本信息', function (Form $form) {
                $form->text('company')->required();
                $form->text('people')->required();
                $form->text('phone')->required();
                $form->text('email')->required();
                $form->text('address')->required();
            })->tab('商户信息', function (Form $form) {
                
                if(Route::currentRouteName() == 'merchants.create'){
                    $form->text('account', __('登陆账号'))->required()->help('机构使用此账号登陆微服务平台');
                    $form->password('password', __('登陆密码'))->required()->help('密码最少6位,数字与字母的组合');
                }

                $form->text('merchant_number')->value("CHB".date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 10), 1))), 0, 5));
                $form->text('merchant_secret')->value(Str::upper(uniqid().uniqid()));
                $form->checkbox('merchant_ability')->options(['applyCard' => '申请信用卡', 'pointsChange' => '积分兑换', 'nocardPay' => '无卡支付'])->saving(function ($value) {
                        return json_encode($value);
                    });
            })->tab('回调配置', function (Form $form) {
                $form->url('apply_card_notify_url');
                $form->url('points_change_notify_url');
                $form->url('nocard_pay_notify_url');

            })->tab('聚合费率', function (Form $form) {

                $form->rate('debit_fee', '借记卡费率(万分位)')->default(0);
                $form->rate('debit_fee_limit', '借记卡封顶(单位:分)')->default(0);
                $form->rate('credit_fee', '贷记卡费率(万分位)')->default(0);

                $form->rate('d0_fee', 'D0额外手续费率(万分位)')->default(0);
                $form->rate('d0_fee_quota', 'D0额外定额手续费(单位:分)')->default(0);

                $form->rate('union_credit_fee', '云闪付贷记卡费率(万分位)')->default(0);
                $form->rate('union_debit_fee', '云闪付借记卡费率(万分位)')->default(0);

                $form->rate('ali_fee', '支付宝费率(万分位)')->default(0);

                $form->rate('wx_fee', '微信费率(万分位)')->default(0);

                //$form->slider('wx_fee', '微信费率(万分位)')->options(['max' => 100, 'min' => 30, 'step' => 1]);
            });



            $form->saving(function (Form $form) {
                // 判断是否是新增操作
                if ($form->isCreating()) {

                    $account = \request('account');
                    $password= \request('password');
                
                    /**
                       @version 查询账户是否存在或使用
                     */
                    $adminUser = \App\AdminUser::where('username', $account)->get();
                    if(!$adminUser->isEmpty()){
                        return $form->error('新开机构商户失败: 该账号已经存在');
                    }

                    // 根据选择的开户类型创建后台登陆账号 并且给与相应的权限
                    $adminUser = \App\AdminUser::create([
                        'username'  =>  $account,
                        'password'  =>  bcrypt($password),
                        'name'      =>  $form->company,
                        'number'    =>  $form->merchant_number,
                    ]);

                    \App\AdminRoleUser::create([ 'role_id'   =>2, 'user_id'   =>$adminUser->id ]);

                }

                // 删除用户提交的数据
                $form->deleteInput('account');
                $form->deleteInput('password');
            });

            $form->tools(function (Form\Tools $tools) {
                // 去掉删除按钮
                $tools->disableDelete();
            });
        });
    }
}
