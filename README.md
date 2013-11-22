# Oauth2 SocialAuth for CodeIgniter

## 关于

本程序修改自[codeigniter-oauth2](https://github.com/philsturgeon/codeigniter-oauth2).
代码默认适配codeigniter框架，简单修改可以适用于任何框架或者非框架使用。有任何疑问或想法请issue或者pull request。


## 修改点

* 可以运行与spark或者none-spark环境下。
* 增加若干参数，支持国内各大平台。
* 加入csrf验证
* 原版providers被移动到provides/beyond the wall/文件夹中，使用者可根据需求自行移动出来使用。

## 新增的providers

* 新浪微博
* QQ互联
* 腾讯微博
* 百度
* 360
* 网易微博
* 搜狐微博
* 豆瓣
* 淘宝
* 天翼
* 人人
* 移动微博
* 飞信
* 开心网
* 多说评论系统

## 演示站点

[查看演示请戳这里](http://oauth24codeigniter.sinaapp.com/)

example文件夹为演示站点的源代码


## 使用说明

* 将Oauth2.php和oauth2文件夹扔进libraries里
* application/config建立oauth2.php，内容如下

```php
//xx代表每个provider的唯一标识，也就是文件名的小写
$config['oauth2']['xx'] = array(
	'id' => 'your app client id',
	'secret' => 'your app client secret'
);
$config['oauth2']['xxx'] = array(
	'id' => 'your app client id',
	'secret' => 'your app client secret'
);
```
* 典型的控制器代码

```php
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sns extends CI_Controller {

    public function __construct()
    {
          parent::__construct();
        $this->session->userdata('is_login') AND redirect();
    }

    public function session($provider = '')
    {
        $this->config->load('oauth2');
        $allowed_providers = $this->config->item('oauth2');
        if ( ! $provider OR ! isset($allowed_providers[$provider]))
        {
            $this->session->set_flashdata('info', '暂不支持'.$provider.'方式登录.');
            redirect();
            return;
        }
        $this->load->library('oauth2');
        $provider = $this->oauth2->provider($provider, $allowed_providers[$provider]);
        $args = $this->input->get();
        if ($args AND !isset($args['code']))
        {
            $this->session->set_flashdata('info', '授权失败了,可能由于应用设置问题或者用户拒绝授权.<br />具体原因:<br />'.json_encode($args));
            redirect();
            return;
        }
        $code = $this->input->get('code', TRUE);
        if ( ! $code)
        {
            $provider->authorize();
            return;
        }
        else
        {
            try
            {
                $token = $provider->access($code);
                $sns_user = $provider->get_user_info($token);
                if (is_array($sns_user))
                {
                    $this->session->set_flashdata('info', '登录成功');
                    $this->session->set_userdata('user', $sns_user);
                    $this->session->set_userdata('is_login', TRUE);
                }
                else
                {
                    $this->session->set_flashdata('info', '获取用户信息失败');
                }
            }
            catch (OAuth2_Exception $e)
            {
                $this->session->set_flashdata('info', '操作失败<pre>'.$e.'</pre>');
            }
        }
        redirect();
    }
}

/* End of file sns.php */
/* Location: ./application/controllers/sns.php */
```

* 参数返回说明

```php
<?php 
//注意由于各个平台不一致,不是所有的参数都有值
return array(
    'via' => '', // provider 唯一标示
    'uid' => '', // 用户在对应平台的唯一标识
    'screen_name' => '', //用户的显示名称，一般为昵称
    'name' => '', // 用户的其它名称
    'location' => '', //用户所在地
    'description' => '', // 用户自我介绍
    'image' => '', // 头像地址
    'access_token' => '', // access_token
    'expire_at' => '', // access_token 对应过期时间
    'refresh_token' => '' // refresh_token
);
```

## LICENSE
Copyright (c) 2013 [chekun](https://github.com/chekun).

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/chekun/oauth2-socialauth-for-codeigniter/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

