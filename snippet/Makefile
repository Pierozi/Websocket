build:
	openssl req -nodes -x509 -newkey rsa:4096 -keyout cert/key.pem -out cert/cert.crt -days 365
	cat cert/cert.crt cert/key.pem >> cert/cert.pem

test:
	openssl s_client -showcerts -connect 127.0.0.1:8889
