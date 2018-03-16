<?php
$config = array (
		//应用ID,您的APPID。
		'app_id' => "2016053101466309",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEAt86hBjX6y/u8rpWn7UIkxOK5s4bjFGl5nLe8jahgno/SO2mX9lfc0nNEpqZ55B5z/LPDRdDSt621qrMuvBEOYErN99JLqLOHBvq8V0KZi/EWiTNIzejYK89U4UEN98IjK5sYGa57k36dr9yoJDZRiJXD3xT6sGJnxvJ6EWhtfqlF/YR6FCusjEfvhZNgE9L6qMi8ztyw4AcljHYjsv0YU5Wwl8DH9T1BhrjUvxStlueNVVeIvcQ8qA6HXLPUhLmd5254O+frQWgj3IkDPbXT7xtwDP97QjTPJ1wdGWo4jWyfcaBPJddVAqJ/2YzJWL2TppZTs2K+6pQWCLJSsSaJoQIDAQABAoIBAFt7QfV/ZEWmEzCpV5zkcLx1Q4uwtNBx9o8je3rdtMj2N+JOGc4HyOYNbLus27nH1l6NccELv/SfRm2hJL+BlbAjSwPu7K0YPToiDR85DIb0BQ1gMvoYy45ycIJ0CGmpfCu103bkuqicOgtPPXhYeJgMQiKDpImpUJFaGZsUaHrDGR8Wk3w5ei8vuErEJkWTOKC7dVUryjgvSeeGqEKO/4P7HsXh+8GSuThFnokdU784PWtzk5AOn/GV5X7G42zLZBzfHsnj0eroMbvBd2h2yCCoF4kDAY3DyLFh9nMw8hRNn12P11Kdw7TZWabIo1NCDZhST177sUDKxS9yMJXT+UkCgYEA2TIgwauYHuMMSFTOOTAiXSOMsqQM1kuxtLF05lXs/Q/PSGFSS89aZISeb3aqJJ7d1A8Nf/E/PLHn9r00kA7VL/iBVuTsl+T1HvwYbIzlbjQxN2S9D9l2nfYdS7PsaafVQpWPUDEZ9dg3amYJV9PheUsO0kx9jggJFa6+uJlLBvMCgYEA2KVn0A6wSoU5peJERchxs2LzsUFcCBGxVFv7Qsj8D6Ata2wv95tzrR//wHHHR+66145kidR17k0Is3b7BRRAX93quzVGm/gVLaBLBFVw8K7fq+kdVtMUIPvrA4XtBrB5tscR+lZpqGsIsSWzrdO9yR+VclqsvkNASNZ2w7yfehsCgYAah4Hyxgfltev5Jcqut49q+v2jkGA1CLfjD03tGI/C9VxnRePseJ5c6soDaWYs5O7JiTEn8Iq92ikwPTofYoBtxJffykSP5Rp/t2EwWSFpDZz5XCevuOtBLh+z8H0vBp4I7QW9UNIP8mIKb/4yKSJAU4ey7j7jy114tYh8OdUtOwKBgQDNpQyK2TaMNjQHe2U1HFSZZAdQLWtvmWPLYNh7h46EQpZ6jqJlliDSqDo7cYUpibm/nUFf99XN0z+8IueZ5aRJm7wR4jtZF776pVowDe57+HMGmuwnm4tS1+44VOsuW1vdnM864sW+gYMprFEHYqOXAyz39IxeujWOLk1j9WsoGwKBgCgipTtcWCc/tM3HOrU3/djPPRqntJyoju2uzP500N53dt02eS3jETY4PR7tk5cACbiSsiOivZLqv5uGbP3meQdLgPAF3MD8iAbudxRh7XXM+NSCyVCZ8Be2mVaa0piBY3S+qVg1nZMMAkg5em3vChsqq8PJAwMYHqG/d8kkpRwR",
		//异步通知地址
		'notify_url' => "http://".$_SERVER['HTTP_HOST']."/Pay/notify",

		//同步跳转
		'return_url' => "http://".$_SERVER['HTTP_HOST']."/Pay/backurl",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
		//'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",


		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAs3h0RcHcZsFJys/c/M33oZpEHvwtU1SuGGSOMmbBqfQWSZwIKeDE3QwCx5VsOPkJhg9DjLKFfde9Y/loRBO9NJ5h8jp6psp7SZNfOI7yY2nMWQdpvYNr06rk2AvNcb9CMA9Qwd56Kot62YNMzDP4DLmrHCu6qLom0HRHUPtvAjuaIbBEIuwXiAxUtaXoRzx1K/a7+Dj/UN5aHeUavDfKLea81vdKoG3+lqiAslZkNaKEdKcEM2XR5rjQ5PfCibtSMrrbdGUR3EpKI8FqdZxnmtsWI4R8Wi0CoH9mMm47ZGOZ13/uB7e7jopRET+4FmMeTh2eDUKhudJdYrOqYygP7QIDAQAB",
		//最大查询重试次数
		'MaxQueryRetry' => "10",

		//查询间隔
		'QueryDuration' => "3"

);