<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
        <meta property="qc:admins" content="2702401645402437451761452631611006375" />
        <meta property="qh.webmaster" content="5107502a77812"/>
        <meta property="author" content="chekun" />
	<title>Oauth2 SocialAuth for CodeIgniter</title>
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }
	::-webkit-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		-moz-box-shadow: 0 0 8px #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Oauth2 SocialAuth for CodeIgniter</h1>
	<div id="body">
                <?php if ($info = $this->session->flashdata('info')): ?>
          		<code><?php echo $info; ?></code>
                <?php endif; ?>
		<h2>使用演示
                	&nbsp;&nbsp;&nbsp;<a href="https://github.com/chekun/Oauth2-SocialAuth-for-CodeIgniter" target="_blank">源代码下载</a>
                        &nbsp;&nbsp;&nbsp;<a href="https://github.com/chekun/Oauth2-SocialAuth-for-CodeIgniter/blob/master/README.md" target="_blank">使用手册</a>
                        
                </h2>
                <p style="color:red">注意：部分服务不给未审核用户使用,所以新浪微博等登陆不上也是正常的，^_^，可以下载代码自行测试。</p>
        <?php foreach ($this->config->item('oauth2') as $via => $provider): ?>
		<p>
          <?php if ($this->session->userdata('is_login') AND $via == $user['via']): ?>
	          你好<?php echo $user['screen_name']; ?>，你是通过<span style="color:red"><?php echo $provider['name']; ?></span>登录的。
                  <?php if ($via != 'duoshuo'): ?>
                  <a href="<?php echo site_url('logout'); ?>">退出</a>
                  <?php else: ?>
                  <a href="http://socialauth-for-codeigniter.duoshuo.com/logout/?sso=1&redirect_uri=<?php echo site_url('logout'); ?>">退出</a>
                  <?php endif; ?>
	          	<br />
	          	<img src="<?php echo $user['image']; ?>" />
	          <?php else: ?>
                  	  <?php if ($via !== 'duoshuo'): ?>
			  <a href="<?php echo site_url('sns/session/'.$via); ?>"><?php echo $provider['name']; ?></a>
                          <?php endif; ?>
	          	  <?php if ($provider['extra']): ?>
	  	          <span><?php echo $provider['extra']; ?></span>
	                  <?php endif; ?>
		  <?php endif; ?>
        </p>

        <?php endforeach; ?>
		<!-- Duoshuo Comment BEGIN -->
			<div class="ds-thread"></div>
			<script type="text/javascript">
			var duoshuoQuery = {
                        	short_name:"socialauth-for-codeigniter",
                        	sso: { 
                                   login: "<?php echo site_url('sns/session/duoshuo'); ?>",
                                   logout: "<?php echo site_url('logout'); ?>"
                               }
                        };
			(function() {
				var ds = document.createElement('script');
				ds.type = 'text/javascript';ds.async = true;
				ds.src = 'http://static.duoshuo.com/embed.js';
				ds.charset = 'UTF-8';
				(document.getElementsByTagName('head')[0] 
				|| document.getElementsByTagName('body')[0]).appendChild(ds);
			})();
			</script>
		<!-- Duoshuo Comment END -->
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>