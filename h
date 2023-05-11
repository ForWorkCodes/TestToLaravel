[0;1;31m×[0m nginx.service - A high performance web server and a reverse proxy server
     Loaded: loaded (/lib/systemd/system/nginx.service; enabled; vendor preset: enabled)
     Active: [0;1;31mfailed[0m (Result: exit-code) since Thu 2023-05-11 14:13:19 MSK; 23min ago
       Docs: man:nginx(8)
    Process: 52682 ExecStartPre=/usr/sbin/nginx -t -q -g daemon on; master_process on; (code=exited, status=0/SUCCESS)
    Process: 52683 ExecStart=/usr/sbin/nginx -g daemon on; master_process on; [0;1;31m(code=exited, status=1/FAILURE)[0m
        CPU: 24ms

May 11 14:13:18 v1877267.hosted-by-vdsina.ru nginx[52683]: nginx: [emerg] bind() to 0.0.0.0:80 failed (98: Unknown error)
May 11 14:13:18 v1877267.hosted-by-vdsina.ru nginx[52683]: nginx: [emerg] bind() to [::]:80 failed (98: Unknown error)
May 11 14:13:18 v1877267.hosted-by-vdsina.ru nginx[52683]: nginx: [emerg] bind() to 0.0.0.0:80 failed (98: Unknown error)
May 11 14:13:18 v1877267.hosted-by-vdsina.ru nginx[52683]: nginx: [emerg] bind() to [::]:80 failed (98: Unknown error)
May 11 14:13:19 v1877267.hosted-by-vdsina.ru nginx[52683]: nginx: [emerg] bind() to 0.0.0.0:80 failed (98: Unknown error)
May 11 14:13:19 v1877267.hosted-by-vdsina.ru nginx[52683]: nginx: [emerg] bind() to [::]:80 failed (98: Unknown error)
May 11 14:13:19 v1877267.hosted-by-vdsina.ru nginx[52683]: nginx: [emerg] still could not bind()
May 11 14:13:19 v1877267.hosted-by-vdsina.ru systemd[1]: [0;1;39m[0;1;31m[0;1;39mnginx.service: Control process exited, code=exited, status=1/FAILURE[0m
May 11 14:13:19 v1877267.hosted-by-vdsina.ru systemd[1]: [0;1;38;5;185m[0;1;39m[0;1;38;5;185mnginx.service: Failed with result 'exit-code'.[0m
May 11 14:13:19 v1877267.hosted-by-vdsina.ru systemd[1]: [0;1;31m[0;1;39m[0;1;31mFailed to start A high performance web server and a reverse proxy server.[0m
