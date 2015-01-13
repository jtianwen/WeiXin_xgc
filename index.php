<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->checkMsg();
}


class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    public function checkMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();

                if(!empty( $keyword )){
                    switch ($keyword)
                    {
                        case "新闻":
                          $this->responseNews();
                          break;  
                        default:
                          $this->responseMenu();
                    }
                    
                }
        }
    }
    public function responseMenu()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            </xml> ";             
                if(!empty( $keyword ))
                {
                    $msgType = "text";
                    $content = "系统正在开发，更多功能敬请期待……\n\n这里是哈工大学工处微信平台。\n回复以下关键字使用相应功能（如“新闻”）：\n1.新闻";
                    
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $content);
                    echo $resultStr;
                }else{
                    echo "Input something...";
                }

        }else {
            echo "";
            exit;
        }
    }
    public function responseNews()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>6</ArticleCount>
                            <Articles>
                            <item>
                                <Title><![CDATA[%s]]></Title> 
                                <Description><![CDATA[%s]]></Description>
                                <PicUrl><![CDATA[%s]]></PicUrl>
                                <Url><![CDATA[%s]]></Url>
                            </item>
                            <item>
                                <Title><![CDATA[%s]]></Title> 
                                <Description><![CDATA[%s]]></Description>
                                <PicUrl><![CDATA[%s]]></PicUrl>
                                <Url><![CDATA[%s]]></Url>
                            </item>
                            <item>
                                <Title><![CDATA[%s]]></Title> 
                                <Description><![CDATA[%s]]></Description>
                                <PicUrl><![CDATA[%s]]></PicUrl>
                                <Url><![CDATA[%s]]></Url>
                            </item>
                            <item>
                                <Title><![CDATA[%s]]></Title> 
                                <Description><![CDATA[%s]]></Description>
                                <PicUrl><![CDATA[%s]]></PicUrl>
                                <Url><![CDATA[%s]]></Url>
                            </item>
                            <item>
                                <Title><![CDATA[%s]]></Title> 
                                <Description><![CDATA[%s]]></Description>
                                <PicUrl><![CDATA[%s]]></PicUrl>
                                <Url><![CDATA[%s]]></Url>
                            </item>
                            <item>
                                <Title><![CDATA[%s]]></Title> 
                                <Description><![CDATA[%s]]></Description>
                                <PicUrl><![CDATA[%s]]></PicUrl>
                                <Url><![CDATA[%s]]></Url>
                            </item>
                            </Articles>
                            </xml> ";             
                if(!empty( $keyword ))
                {
                    $msgType = "news";
                    $title = "系统正在开发，敬请期待……";
                    $description = "哈工大学工处";
                    $picUrl = "http://1.tianwenweixintest.sinaapp.com/image/1.jpg";
                    $url = "http://today.hit.edu.cn/depart/30.htm";

                    $title1 = "2014年度台湾、港澳及华侨本科生奖学金建议名单公示";
                    $description1 = "哈工大学工处";
                    $picUrl1 = "http://1.tianwenweixintest.sinaapp.com/image/200733110159906.jpg";
                    $url1 = "http://today.hit.edu.cn/news/2015/01-11/9380639010RL0.htm";
                    
                    $title2 = "奖学金发放公告";
                    $description2 = "哈工大学工处";
                    $picUrl2 = "http://1.tianwenweixintest.sinaapp.com/image/200733110159906.jpg";
                    $url2 = "http://today.hit.edu.cn/news/2015/01-10/5241046110RL0.htm";
                    
                    $title3 = "2014年度学生工作者能力素质提升工程课题立项结果公布";
                    $description3 = "哈工大学工处";
                    $picUrl3 = "http://1.tianwenweixintest.sinaapp.com/image/200733110159906.jpg";
                    $url3 = "http://today.hit.edu.cn/news/2015/01-08/4421236110RL1.htm";
                    
                    $title4 = "2014年度富士施乐（深圳）奖学金颁奖典礼成功举行";
                    $description4 = "哈工大学工处";
                    $picUrl4 = "http://1.tianwenweixintest.sinaapp.com/image/200733110159906.jpg";
                    $url4 = "http://today.hit.edu.cn/news/2015/01-08/7224855110RL0.htm";
                    
                    $title5 = "关于推选参加2014年黑龙江省辅导员年度人物评选活动的公示";
                    $description5 = "哈工大学工处";
                    $picUrl5 = "http://1.tianwenweixintest.sinaapp.com/image/200733110159906.jpg";
                    $url5 = "http://today.hit.edu.cn/news/2014/12-31/3513524121RL1.htm";
                    
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, 
                        $title, $description, $picUrl, $url, 
                        $title1, $description1, $picUrl1, $url1,
                        $title2, $description2, $picUrl2, $url2,
                        $title3, $description3, $picUrl3, $url3,
                        $title4, $description4, $picUrl4, $url4,
                        $title5, $description5, $picUrl5, $url5);
                    echo $resultStr;
                }else{
                    echo "Input something...";
                }

        }else {
            echo "";
            exit;
        }
    }
        
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
                
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>