
ajax: (核心三步)
1: xhr = new XMLHttpRequest();
2: xhr.open('get',url,true);
3: xhr.send(null);


ajax: post
1: xhr = new XMLHttpRequest();
2: xhr.open('get',url,true);
3: xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded; charset=utf-8');
4: xhr.send(data);



json:
1: JSON.stringify(obj);
2: JSON.parse(text);

3: json_decode();
4: json_encode();


xml: 1:strToXml    2:xmlToStr to transfer
1: (new DOMParser()).parseFromString('xmlstr','text/xml');
2: (new XMLSerializer()).serializeToString(data);


//<data><student name="xiaoguai" age="20"/></data>
3: $xmlstr = $_POST['data'];
4: $obj = simplexml_load_string($xmlstr);
///标签用 -> 属性用 []
5: echo $obj->student['name'];



ajax跨域:
1: Access-Control-Allow-Origin：*



jsonp:
1: createElement('script')
2: .src=newUrl
3: appendChild()



ajax文件上传
1: fmdata = new FormData(this);//自动封装form数据
2: xhr.send(fmdata);           //无需setHeader

3: move_uploaded_file($_FILES['pic']['tmp_name'], 'upload/'.$_FILES['pic']['name']);
    /*进度显示*/
4: <progress value="20" max="100"></progress>
5: <div id="prog"> <div id="progress"></div> </div>




/*一些常见的疑惑*/
1: 一个element只能被add一次
2: 一个script只能初始化一次执行js,以后src改变无效
3: ajax GET url编码 encodeURI(url)


