<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection alias
     * @property Grid\Column|Collection authors
     * @property Grid\Column|Collection enable
     * @property Grid\Column|Collection imported
     * @property Grid\Column|Collection config
     * @property Grid\Column|Collection require
     * @property Grid\Column|Collection require_dev
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection company
     * @property Grid\Column|Collection people
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection address
     * @property Grid\Column|Collection merchant_number
     * @property Grid\Column|Collection merchant_secret
     * @property Grid\Column|Collection merchant_ability
     * @property Grid\Column|Collection apply_card_notify_url
     * @property Grid\Column|Collection points_change_notify_url
     * @property Grid\Column|Collection nocard_pay_notify_url
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection card_images
     * @property Grid\Column|Collection money
     * @property Grid\Column|Collection pip
     * @property Grid\Column|Collection ligheight
     * @property Grid\Column|Collection sort
     * @property Grid\Column|Collection recommand
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection apply_url
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection order_no
     * @property Grid\Column|Collection idcard
     * @property Grid\Column|Collection order_title
     * @property Grid\Column|Collection order_money
     * @property Grid\Column|Collection order_pic
     * @property Grid\Column|Collection pay_money
     * @property Grid\Column|Collection verfity_time
     * @property Grid\Column|Collection order_remark
     * @property Grid\Column|Collection notify_url
     * @property Grid\Column|Collection notify_answ
     * @property Grid\Column|Collection ident
     * @property Grid\Column|Collection merchant
     * @property Grid\Column|Collection card_id
     * @property Grid\Column|Collection order_pip
     * @property Grid\Column|Collection notify_count
     * @property Grid\Column|Collection select_type
     * @property Grid\Column|Collection need_points
     * @property Grid\Column|Collection change_count
     * @property Grid\Column|Collection change_type
     * @property Grid\Column|Collection product_money
     * @property Grid\Column|Collection demo
     * @property Grid\Column|Collection product_id
     * @property Grid\Column|Collection mcc
     * @property Grid\Column|Collection explain
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection merchant_name
     * @property Grid\Column|Collection mobile
     * @property Grid\Column|Collection merchant_name_attr
     * @property Grid\Column|Collection merchant_prop
     * @property Grid\Column|Collection merchant_city
     * @property Grid\Column|Collection merchant_county
     * @property Grid\Column|Collection merchant_address
     * @property Grid\Column|Collection merchant_tel
     * @property Grid\Column|Collection reg_no
     * @property Grid\Column|Collection reg_expd
     * @property Grid\Column|Collection card_no
     * @property Grid\Column|Collection card_name
     * @property Grid\Column|Collection card_expd
     * @property Grid\Column|Collection bank_link
     * @property Grid\Column|Collection bank_no
     * @property Grid\Column|Collection bank_name
     * @property Grid\Column|Collection debit_fee
     * @property Grid\Column|Collection debit_fee_limit
     * @property Grid\Column|Collection credit_fee
     * @property Grid\Column|Collection d0_fee
     * @property Grid\Column|Collection d0_fee_quota
     * @property Grid\Column|Collection union_credit_fee
     * @property Grid\Column|Collection union_debit_fee
     * @property Grid\Column|Collection ali_fee
     * @property Grid\Column|Collection wx_fee
     * @property Grid\Column|Collection out_mercid
     * @property Grid\Column|Collection sett_type
     * @property Grid\Column|Collection pic_xy
     * @property Grid\Column|Collection pic_zz
     * @property Grid\Column|Collection pic_yhk
     * @property Grid\Column|Collection pic_sfz1
     * @property Grid\Column|Collection pic_sfz2
     * @property Grid\Column|Collection pic_jj
     * @property Grid\Column|Collection pic_mt
     * @property Grid\Column|Collection pic_nj
     * @property Grid\Column|Collection width
     * @property Grid\Column|Collection user_email
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection path
     * @property Grid\Column|Collection method
     * @property Grid\Column|Collection ip
     * @property Grid\Column|Collection input
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection nofity_count
     * @property Grid\Column|Collection no
     * @property Grid\Column|Collection dy_no
     * @property Grid\Column|Collection term_no
     * @property Grid\Column|Collection code_url
     * @property Grid\Column|Collection call_url
     * @property Grid\Column|Collection state
     * @property Grid\Column|Collection call_count
     * @property Grid\Column|Collection call_answer
     * @property Grid\Column|Collection dy_return
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection attempts
     * @property Grid\Column|Collection reserved_at
     * @property Grid\Column|Collection available_at
     * @property Grid\Column|Collection merc_no
     * @property Grid\Column|Collection sn
     * @property Grid\Column|Collection dy_term_no
     * @property Grid\Column|Collection term_name
     * @property Grid\Column|Collection term_address
     * @property Grid\Column|Collection merchant_mcc
     * @property Grid\Column|Collection sett_state
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection email_verified_at
     *
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection alias(string $label = null)
     * @method Grid\Column|Collection authors(string $label = null)
     * @method Grid\Column|Collection enable(string $label = null)
     * @method Grid\Column|Collection imported(string $label = null)
     * @method Grid\Column|Collection config(string $label = null)
     * @method Grid\Column|Collection require(string $label = null)
     * @method Grid\Column|Collection require_dev(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection company(string $label = null)
     * @method Grid\Column|Collection people(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection address(string $label = null)
     * @method Grid\Column|Collection merchant_number(string $label = null)
     * @method Grid\Column|Collection merchant_secret(string $label = null)
     * @method Grid\Column|Collection merchant_ability(string $label = null)
     * @method Grid\Column|Collection apply_card_notify_url(string $label = null)
     * @method Grid\Column|Collection points_change_notify_url(string $label = null)
     * @method Grid\Column|Collection nocard_pay_notify_url(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection card_images(string $label = null)
     * @method Grid\Column|Collection money(string $label = null)
     * @method Grid\Column|Collection pip(string $label = null)
     * @method Grid\Column|Collection ligheight(string $label = null)
     * @method Grid\Column|Collection sort(string $label = null)
     * @method Grid\Column|Collection recommand(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection apply_url(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection order_no(string $label = null)
     * @method Grid\Column|Collection idcard(string $label = null)
     * @method Grid\Column|Collection order_title(string $label = null)
     * @method Grid\Column|Collection order_money(string $label = null)
     * @method Grid\Column|Collection order_pic(string $label = null)
     * @method Grid\Column|Collection pay_money(string $label = null)
     * @method Grid\Column|Collection verfity_time(string $label = null)
     * @method Grid\Column|Collection order_remark(string $label = null)
     * @method Grid\Column|Collection notify_url(string $label = null)
     * @method Grid\Column|Collection notify_answ(string $label = null)
     * @method Grid\Column|Collection ident(string $label = null)
     * @method Grid\Column|Collection merchant(string $label = null)
     * @method Grid\Column|Collection card_id(string $label = null)
     * @method Grid\Column|Collection order_pip(string $label = null)
     * @method Grid\Column|Collection notify_count(string $label = null)
     * @method Grid\Column|Collection select_type(string $label = null)
     * @method Grid\Column|Collection need_points(string $label = null)
     * @method Grid\Column|Collection change_count(string $label = null)
     * @method Grid\Column|Collection change_type(string $label = null)
     * @method Grid\Column|Collection product_money(string $label = null)
     * @method Grid\Column|Collection demo(string $label = null)
     * @method Grid\Column|Collection product_id(string $label = null)
     * @method Grid\Column|Collection mcc(string $label = null)
     * @method Grid\Column|Collection explain(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection merchant_name(string $label = null)
     * @method Grid\Column|Collection mobile(string $label = null)
     * @method Grid\Column|Collection merchant_name_attr(string $label = null)
     * @method Grid\Column|Collection merchant_prop(string $label = null)
     * @method Grid\Column|Collection merchant_city(string $label = null)
     * @method Grid\Column|Collection merchant_county(string $label = null)
     * @method Grid\Column|Collection merchant_address(string $label = null)
     * @method Grid\Column|Collection merchant_tel(string $label = null)
     * @method Grid\Column|Collection reg_no(string $label = null)
     * @method Grid\Column|Collection reg_expd(string $label = null)
     * @method Grid\Column|Collection card_no(string $label = null)
     * @method Grid\Column|Collection card_name(string $label = null)
     * @method Grid\Column|Collection card_expd(string $label = null)
     * @method Grid\Column|Collection bank_link(string $label = null)
     * @method Grid\Column|Collection bank_no(string $label = null)
     * @method Grid\Column|Collection bank_name(string $label = null)
     * @method Grid\Column|Collection debit_fee(string $label = null)
     * @method Grid\Column|Collection debit_fee_limit(string $label = null)
     * @method Grid\Column|Collection credit_fee(string $label = null)
     * @method Grid\Column|Collection d0_fee(string $label = null)
     * @method Grid\Column|Collection d0_fee_quota(string $label = null)
     * @method Grid\Column|Collection union_credit_fee(string $label = null)
     * @method Grid\Column|Collection union_debit_fee(string $label = null)
     * @method Grid\Column|Collection ali_fee(string $label = null)
     * @method Grid\Column|Collection wx_fee(string $label = null)
     * @method Grid\Column|Collection out_mercid(string $label = null)
     * @method Grid\Column|Collection sett_type(string $label = null)
     * @method Grid\Column|Collection pic_xy(string $label = null)
     * @method Grid\Column|Collection pic_zz(string $label = null)
     * @method Grid\Column|Collection pic_yhk(string $label = null)
     * @method Grid\Column|Collection pic_sfz1(string $label = null)
     * @method Grid\Column|Collection pic_sfz2(string $label = null)
     * @method Grid\Column|Collection pic_jj(string $label = null)
     * @method Grid\Column|Collection pic_mt(string $label = null)
     * @method Grid\Column|Collection pic_nj(string $label = null)
     * @method Grid\Column|Collection width(string $label = null)
     * @method Grid\Column|Collection user_email(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection path(string $label = null)
     * @method Grid\Column|Collection method(string $label = null)
     * @method Grid\Column|Collection ip(string $label = null)
     * @method Grid\Column|Collection input(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection nofity_count(string $label = null)
     * @method Grid\Column|Collection no(string $label = null)
     * @method Grid\Column|Collection dy_no(string $label = null)
     * @method Grid\Column|Collection term_no(string $label = null)
     * @method Grid\Column|Collection code_url(string $label = null)
     * @method Grid\Column|Collection call_url(string $label = null)
     * @method Grid\Column|Collection state(string $label = null)
     * @method Grid\Column|Collection call_count(string $label = null)
     * @method Grid\Column|Collection call_answer(string $label = null)
     * @method Grid\Column|Collection dy_return(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection attempts(string $label = null)
     * @method Grid\Column|Collection reserved_at(string $label = null)
     * @method Grid\Column|Collection available_at(string $label = null)
     * @method Grid\Column|Collection merc_no(string $label = null)
     * @method Grid\Column|Collection sn(string $label = null)
     * @method Grid\Column|Collection dy_term_no(string $label = null)
     * @method Grid\Column|Collection term_name(string $label = null)
     * @method Grid\Column|Collection term_address(string $label = null)
     * @method Grid\Column|Collection merchant_mcc(string $label = null)
     * @method Grid\Column|Collection sett_state(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection name
     * @property Show\Field|Collection version
     * @property Show\Field|Collection alias
     * @property Show\Field|Collection authors
     * @property Show\Field|Collection enable
     * @property Show\Field|Collection imported
     * @property Show\Field|Collection config
     * @property Show\Field|Collection require
     * @property Show\Field|Collection require_dev
     * @property Show\Field|Collection id
     * @property Show\Field|Collection company
     * @property Show\Field|Collection people
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection email
     * @property Show\Field|Collection address
     * @property Show\Field|Collection merchant_number
     * @property Show\Field|Collection merchant_secret
     * @property Show\Field|Collection merchant_ability
     * @property Show\Field|Collection apply_card_notify_url
     * @property Show\Field|Collection points_change_notify_url
     * @property Show\Field|Collection nocard_pay_notify_url
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection card_images
     * @property Show\Field|Collection money
     * @property Show\Field|Collection pip
     * @property Show\Field|Collection ligheight
     * @property Show\Field|Collection sort
     * @property Show\Field|Collection recommand
     * @property Show\Field|Collection status
     * @property Show\Field|Collection apply_url
     * @property Show\Field|Collection content
     * @property Show\Field|Collection order_no
     * @property Show\Field|Collection idcard
     * @property Show\Field|Collection order_title
     * @property Show\Field|Collection order_money
     * @property Show\Field|Collection order_pic
     * @property Show\Field|Collection pay_money
     * @property Show\Field|Collection verfity_time
     * @property Show\Field|Collection order_remark
     * @property Show\Field|Collection notify_url
     * @property Show\Field|Collection notify_answ
     * @property Show\Field|Collection ident
     * @property Show\Field|Collection merchant
     * @property Show\Field|Collection card_id
     * @property Show\Field|Collection order_pip
     * @property Show\Field|Collection notify_count
     * @property Show\Field|Collection select_type
     * @property Show\Field|Collection need_points
     * @property Show\Field|Collection change_count
     * @property Show\Field|Collection change_type
     * @property Show\Field|Collection product_money
     * @property Show\Field|Collection demo
     * @property Show\Field|Collection product_id
     * @property Show\Field|Collection mcc
     * @property Show\Field|Collection explain
     * @property Show\Field|Collection type
     * @property Show\Field|Collection merchant_name
     * @property Show\Field|Collection mobile
     * @property Show\Field|Collection merchant_name_attr
     * @property Show\Field|Collection merchant_prop
     * @property Show\Field|Collection merchant_city
     * @property Show\Field|Collection merchant_county
     * @property Show\Field|Collection merchant_address
     * @property Show\Field|Collection merchant_tel
     * @property Show\Field|Collection reg_no
     * @property Show\Field|Collection reg_expd
     * @property Show\Field|Collection card_no
     * @property Show\Field|Collection card_name
     * @property Show\Field|Collection card_expd
     * @property Show\Field|Collection bank_link
     * @property Show\Field|Collection bank_no
     * @property Show\Field|Collection bank_name
     * @property Show\Field|Collection debit_fee
     * @property Show\Field|Collection debit_fee_limit
     * @property Show\Field|Collection credit_fee
     * @property Show\Field|Collection d0_fee
     * @property Show\Field|Collection d0_fee_quota
     * @property Show\Field|Collection union_credit_fee
     * @property Show\Field|Collection union_debit_fee
     * @property Show\Field|Collection ali_fee
     * @property Show\Field|Collection wx_fee
     * @property Show\Field|Collection out_mercid
     * @property Show\Field|Collection sett_type
     * @property Show\Field|Collection pic_xy
     * @property Show\Field|Collection pic_zz
     * @property Show\Field|Collection pic_yhk
     * @property Show\Field|Collection pic_sfz1
     * @property Show\Field|Collection pic_sfz2
     * @property Show\Field|Collection pic_jj
     * @property Show\Field|Collection pic_mt
     * @property Show\Field|Collection pic_nj
     * @property Show\Field|Collection width
     * @property Show\Field|Collection user_email
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection path
     * @property Show\Field|Collection method
     * @property Show\Field|Collection ip
     * @property Show\Field|Collection input
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection nofity_count
     * @property Show\Field|Collection no
     * @property Show\Field|Collection dy_no
     * @property Show\Field|Collection term_no
     * @property Show\Field|Collection code_url
     * @property Show\Field|Collection call_url
     * @property Show\Field|Collection state
     * @property Show\Field|Collection call_count
     * @property Show\Field|Collection call_answer
     * @property Show\Field|Collection dy_return
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection attempts
     * @property Show\Field|Collection reserved_at
     * @property Show\Field|Collection available_at
     * @property Show\Field|Collection merc_no
     * @property Show\Field|Collection sn
     * @property Show\Field|Collection dy_term_no
     * @property Show\Field|Collection term_name
     * @property Show\Field|Collection term_address
     * @property Show\Field|Collection merchant_mcc
     * @property Show\Field|Collection sett_state
     * @property Show\Field|Collection token
     * @property Show\Field|Collection email_verified_at
     *
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection alias(string $label = null)
     * @method Show\Field|Collection authors(string $label = null)
     * @method Show\Field|Collection enable(string $label = null)
     * @method Show\Field|Collection imported(string $label = null)
     * @method Show\Field|Collection config(string $label = null)
     * @method Show\Field|Collection require(string $label = null)
     * @method Show\Field|Collection require_dev(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection company(string $label = null)
     * @method Show\Field|Collection people(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection address(string $label = null)
     * @method Show\Field|Collection merchant_number(string $label = null)
     * @method Show\Field|Collection merchant_secret(string $label = null)
     * @method Show\Field|Collection merchant_ability(string $label = null)
     * @method Show\Field|Collection apply_card_notify_url(string $label = null)
     * @method Show\Field|Collection points_change_notify_url(string $label = null)
     * @method Show\Field|Collection nocard_pay_notify_url(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection card_images(string $label = null)
     * @method Show\Field|Collection money(string $label = null)
     * @method Show\Field|Collection pip(string $label = null)
     * @method Show\Field|Collection ligheight(string $label = null)
     * @method Show\Field|Collection sort(string $label = null)
     * @method Show\Field|Collection recommand(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection apply_url(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection order_no(string $label = null)
     * @method Show\Field|Collection idcard(string $label = null)
     * @method Show\Field|Collection order_title(string $label = null)
     * @method Show\Field|Collection order_money(string $label = null)
     * @method Show\Field|Collection order_pic(string $label = null)
     * @method Show\Field|Collection pay_money(string $label = null)
     * @method Show\Field|Collection verfity_time(string $label = null)
     * @method Show\Field|Collection order_remark(string $label = null)
     * @method Show\Field|Collection notify_url(string $label = null)
     * @method Show\Field|Collection notify_answ(string $label = null)
     * @method Show\Field|Collection ident(string $label = null)
     * @method Show\Field|Collection merchant(string $label = null)
     * @method Show\Field|Collection card_id(string $label = null)
     * @method Show\Field|Collection order_pip(string $label = null)
     * @method Show\Field|Collection notify_count(string $label = null)
     * @method Show\Field|Collection select_type(string $label = null)
     * @method Show\Field|Collection need_points(string $label = null)
     * @method Show\Field|Collection change_count(string $label = null)
     * @method Show\Field|Collection change_type(string $label = null)
     * @method Show\Field|Collection product_money(string $label = null)
     * @method Show\Field|Collection demo(string $label = null)
     * @method Show\Field|Collection product_id(string $label = null)
     * @method Show\Field|Collection mcc(string $label = null)
     * @method Show\Field|Collection explain(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection merchant_name(string $label = null)
     * @method Show\Field|Collection mobile(string $label = null)
     * @method Show\Field|Collection merchant_name_attr(string $label = null)
     * @method Show\Field|Collection merchant_prop(string $label = null)
     * @method Show\Field|Collection merchant_city(string $label = null)
     * @method Show\Field|Collection merchant_county(string $label = null)
     * @method Show\Field|Collection merchant_address(string $label = null)
     * @method Show\Field|Collection merchant_tel(string $label = null)
     * @method Show\Field|Collection reg_no(string $label = null)
     * @method Show\Field|Collection reg_expd(string $label = null)
     * @method Show\Field|Collection card_no(string $label = null)
     * @method Show\Field|Collection card_name(string $label = null)
     * @method Show\Field|Collection card_expd(string $label = null)
     * @method Show\Field|Collection bank_link(string $label = null)
     * @method Show\Field|Collection bank_no(string $label = null)
     * @method Show\Field|Collection bank_name(string $label = null)
     * @method Show\Field|Collection debit_fee(string $label = null)
     * @method Show\Field|Collection debit_fee_limit(string $label = null)
     * @method Show\Field|Collection credit_fee(string $label = null)
     * @method Show\Field|Collection d0_fee(string $label = null)
     * @method Show\Field|Collection d0_fee_quota(string $label = null)
     * @method Show\Field|Collection union_credit_fee(string $label = null)
     * @method Show\Field|Collection union_debit_fee(string $label = null)
     * @method Show\Field|Collection ali_fee(string $label = null)
     * @method Show\Field|Collection wx_fee(string $label = null)
     * @method Show\Field|Collection out_mercid(string $label = null)
     * @method Show\Field|Collection sett_type(string $label = null)
     * @method Show\Field|Collection pic_xy(string $label = null)
     * @method Show\Field|Collection pic_zz(string $label = null)
     * @method Show\Field|Collection pic_yhk(string $label = null)
     * @method Show\Field|Collection pic_sfz1(string $label = null)
     * @method Show\Field|Collection pic_sfz2(string $label = null)
     * @method Show\Field|Collection pic_jj(string $label = null)
     * @method Show\Field|Collection pic_mt(string $label = null)
     * @method Show\Field|Collection pic_nj(string $label = null)
     * @method Show\Field|Collection width(string $label = null)
     * @method Show\Field|Collection user_email(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection path(string $label = null)
     * @method Show\Field|Collection method(string $label = null)
     * @method Show\Field|Collection ip(string $label = null)
     * @method Show\Field|Collection input(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection nofity_count(string $label = null)
     * @method Show\Field|Collection no(string $label = null)
     * @method Show\Field|Collection dy_no(string $label = null)
     * @method Show\Field|Collection term_no(string $label = null)
     * @method Show\Field|Collection code_url(string $label = null)
     * @method Show\Field|Collection call_url(string $label = null)
     * @method Show\Field|Collection state(string $label = null)
     * @method Show\Field|Collection call_count(string $label = null)
     * @method Show\Field|Collection call_answer(string $label = null)
     * @method Show\Field|Collection dy_return(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection attempts(string $label = null)
     * @method Show\Field|Collection reserved_at(string $label = null)
     * @method Show\Field|Collection available_at(string $label = null)
     * @method Show\Field|Collection merc_no(string $label = null)
     * @method Show\Field|Collection sn(string $label = null)
     * @method Show\Field|Collection dy_term_no(string $label = null)
     * @method Show\Field|Collection term_name(string $label = null)
     * @method Show\Field|Collection term_address(string $label = null)
     * @method Show\Field|Collection merchant_mcc(string $label = null)
     * @method Show\Field|Collection sett_state(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
