​	根据RFC规范，**GET的语义是从服务器获取指定的资源，**这个资源可以是静态的文本，页面，图片视频等。GET请求的参数位置一般是写在URL中，URL规定只能支持ASCLL，所以GET请求的参数只允许ASCLL字符，而且浏览器会对URL的长度有限制（HTTP协议本身对 URL长度并没有做任何规定）。

​	根据RFC规范，**POST的语义请求是根据请求负荷（报文body）对指定的资源做出处理，**具体的处理方式视资源类型而不同。POST请求携带数据的位置一般是写在报文body中，body中的数据可以是任意格式的数据，只要客户端与服务端协商好即可，而且浏览器不会对body大小做限制。