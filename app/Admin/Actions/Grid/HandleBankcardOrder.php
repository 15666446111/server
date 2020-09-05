<?php

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Admin;
use Illuminate\Http\Request;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Traits\HasPermissions;
use App\Admin\Actions\Form\ImportMcc;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Dcat\Admin\Grid\RowAction;
use App\Admin\Forms\HandleBankcardForm;

class HandleBankcardOrder extends RowAction
{
    /**
     * @return string
     */
	protected $title = '订单处理';

    /**
     * @Author    Pudding
     * @DateTime  2020-09-04
     * @copyright [copyright]
     * @license   [license]
     * @version   [ 弹窗表单 ]
     * @return    [type]      [description]
     */
    public function render()
    {
        $id = "reset-pwd-{$this->getKey()}";

        // 模态窗
        $this->modal($id);

        return <<<HTML
        <span class="grid-expand" data-toggle="modal" data-target="#{$id}"><a href="#"> {$this->title} </a></span>
HTML;

    }


    protected function modal($id)
    {
        $form = new HandleBankcardForm($this->getKey());

        // 通过 Admin::html 方法设置模态窗HTML
        Admin::html(
            <<<HTML
<div class="modal fade" id="{$id}">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{$this->title}</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        {$form->render()}
      </div>
    </div>
  </div>
</div>
HTML
        );
    }



    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }

}
