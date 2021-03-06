{#
This file is part of EC-CUBE

Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.

http://www.lockon.co.jp/

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
#}
{% extends 'default_frame.twig' %}

{% set mypageno = 'delivery' %}

{% set body_class = 'mypage' %}

{% block main %}
    <h1 class="page-heading">マイページ/お届け先編集</h1>
    <div id="delivery_wrap" class="container-fluid">

        {{ include('Mypage/navi.twig') }}
        <style type="text/css">
@media only screen and (max-width: 768px){
.column.is-edit .btn_edit {
    position: relative;
    float: right;
    top: -28px;
}
}
        </style>

        <div id="delivery_list_box" class="row">
            <div id="delivery_list_box__body" class="col-md-12">
                <p id="delivery_list_box__customer_addresses" class="intro"><strong>{{ Customer.CustomerAddresses|length }}件</strong>のお届け先があります。</p>
                    <div id="deliveradd_select" class="row">
                        <div id="delivery_list_box__body_inner" class="col-sm-10 col-sm-offset-1">
                            <p id="delivery_box__new_button">
                            {% if Customer.CustomerAddresses|length < app.config.deliv_addr_max %}
                                <a href="{{ url('mypage_delivery_new') }}">
                                    <button class="btn btn-default btn-sm">新規お届け先を追加する</button>
                                </a>
                            {% else %}
                                <span id="delivery_box__deliv_addr_max" class="text-danger">お届け先登録の上限の{{ app.config.deliv_addr_max }}件に達しています。お届け先を入力したい場合は、削除か変更を行ってください</span>
                            {% endif %}
                            </p>

                            {% if Customer.CustomerAddresses|length > 0 %}
                            <div id="delivery_address_list" class="table address_table">
                                <div id="delivery_address_list__list" class="tbody">

                                    {% for CustomerAddress in Customer.CustomerAddresses %}
                                        <div id="delivery_address_list__item--{{ CustomerAddress.id }}" class="addr_box tr">
                                            <div id="delivery_address_list__delete--{{ CustomerAddress.id }}" class="icon_edit td">
                                            {% if Customer.CustomerAddresses|length != 1 %}
                                                <a href="{{ url('mypage_delivery_delete', { id : CustomerAddress.id }) }}" {{ csrf_token_for_anchor() }} data-method="delete">
                                                    <svg class="cb cb-close"><use xlink:href="#cb-close" /></svg>
                                                </a>
                                            {% endif %}
                                            </div>
                                            <div id="delivery_address_list__address--{{ CustomerAddress.id }}" class="column is-edit td">
                                                <label for="address01">
                                                <p id="delivery_address_list__address_detail--{{ CustomerAddress.id }}" class="address">
                                                    {{ CustomerAddress.name01 }}&nbsp;{{ CustomerAddress.name02 }}<br>
                                                    〒{{ CustomerAddress.zip01 }}-{{ CustomerAddress.zip02 }}　{{ CustomerAddress.Pref }}{{ CustomerAddress.addr01 }}{{ CustomerAddress.addr02 }}<br>
                                                    {{ CustomerAddress.tel01 }}-{{ CustomerAddress.tel02 }}-{{ CustomerAddress.tel03 }}</p>
                                                </label>
                                                <p id="delivery_address_list__edit_button--{{ CustomerAddress.id }}" class="btn_edit">
                                                    <a href="{{ url('mypage_delivery_edit', { id : CustomerAddress.id }) }}">
                                                        <button class="btn btn-default btn-sm">変更</button>
                                                    </a>
                                                </p>
                                            </div>
                                        </div><!--/addr_box-->
                                    {% endfor %}

                                </div>
                            </div><!--/table-->
                            {% endif %}

                        </div>
                    </div><!-- /.row -->

            </div><!-- /.col -->
        </div><!-- /.row -->

    </div>
{% endblock %}
