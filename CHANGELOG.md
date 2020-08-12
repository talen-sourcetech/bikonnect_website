# Changelog

All notable changes to this project will be documented in this file.

## 2020-08-12

### Changed

1.後台解決方案更新
2.前台解決方案更新
3.前台更新

/app/SolutionApplicationLangModel.php
/app/SolutionApplicationModel.php
/app/SolutionAspectModel.php
/app/SolutionLangModel.php
/app/SolutionModel.php
/app/Http/Controllers/Backend/SolutionController.php
/app/Http/Controllers/Frontend/MainController.php

/resources/views/backend/product/add.blade.php
/resources/views/backend/shared/_nav.blade.php
/resources/views/backend/solution/addaspect.blade.php
/resources/views/backend/solution/application.blade.php
/resources/views/backend/solution/aspect.blade.php
/resources/views/backend/solution/editapplication.blade.php
/resources/views/backend/solution/editaspect.blade.php
/resources/views/backend/solution/add.blade.php
/resources/views/backend/solution/edit.blade.php
/resources/views/backend/solution/index.blade.php

/resources/views/frontend/blog_detail.blade.php
/resources/views/frontend/index.blade.php
/resources/views/frontend/product.blade.php
/resources/views/frontend/solution.blade.php
/resources/views/frontend/shared/_footer.blade.php
/resources/views/frontend/shared/_header.blade.php
/resources/views/frontend/shared/_layout.blade.php
/resources/views/frontend/shared/_script.blade.php
/resources/views/frontend/shared/_sidebar.blade.php

/routes/web.php

/public/frontend/images/sprite.png
/public/frontend/styles/main.css
/public/frontend/scripts/featherlight.js
/public/frontend/scripts/jquery-1.7.0.min.js
/public/frontend/scripts/wow.min.js
/public/frontend/styles/animate.css
/public/frontend/styles/featherlight.css

## 2020-05-21

### Changed

1.前台Blog可以正常顯示
2.後台產品預覽
3.後台Blog插入圖片

/app/Http/Controllers/Backend/BlogController.php
/resources/views/backend/index.blade.php

## 2020-05-20

### Changed

1.前台Blog參數大小寫錯誤
2.SSL本地端判斷

/resources/views/frontend/blog.blade.php
/Http/Middleware/UseSSL.php
/Http/Kernel.php
/routes/web.php

## 2020-05-18

### Changed

後台產品清單顯示英文語系的圖

/resources/views/backend/product/index.blade.php

## 2020-05-18

### Changed

header錯誤修正

/resources/views/frontend/shared/_header.blade.php

## 2020-05-18

### Changed

產品新增頁錯誤修正

/resources/views/backend/product/add.blade.php

## 2020-05-06

### Changed

1.加入GA

/resources/views/frontend/shared/_layout.blade.php

## 2020-04-10

### Changed

1.製作錯誤頁面，語系錯誤會倒到錯誤頁面

/routes/web.php

/app/Http/Controllers/Backend/SolutionController.php

/app/Http/Controllers/Frontend/MainController.php

/app/Http/Controllers/Frontend/ErrorController.php

/resources/views/frontend/error.blade.php

/app/Http/Middleware/DetectLanguageMiddleware.php

2.修正部落格改成url回復錯誤

/resources/views/frontend/blog_detail.blade.php

/resources/views/backend/blog/add.blade.php

## 2020-04-07

### Changed

1.大標題 " Application Range " 要能維護 

/resources/views/backend/solution/title.blade.php

/app/SolutionTitleLangModel.php

/app/Http/Controllers/Backend/SolutionController.php

2.部落格網址中間亂碼處，改成有意義的英文字

/app/Http/Controllers/Frontend/MainController.php

/resources/views/backend/blog/edit.blade.php

/app/Http/Controllers/Backend/BlogController.php

/resources/views/frontend/blog.blade.php

/resources/views/backend/blog/add.blade.php

## 2020-03-31

### Changed
1.ajax的url改成secure_url來加上https

/resources/views/backend/blog/edit.blade.php

/resources/views/frontend/blog.blade.php

/resources/views/backend/blog/add.blade.php

2.後台blog 編輯器上傳圖片修正

/Controllers/Backend/BlogController.php

## 2020-01-15 - 2

### Changed
-  application 後台大小寫問題

app/Http/Controllers/Backend/SolutionController.php

## 2020-01-15 - 1

### Changed
-  Solution頁上面橫幅標題 > E-Bike Data Service Solution
-  Solution頁 > Application Range > 標題、圖片、文字
-  Solution頁 > 再切一個圖文區域出來(放Bikonnect架構圖)
-  Product頁 > 每頁產品 > 前台顯示DM下載/後台DM上傳維護。每頁產品獨立DM上傳，中英文分開。
-  About us > 歷史沿革 > Business Timeline 標題文字更改
-  Solution頁 > DM下載/後台DM上傳
-  產品連結有意義的字--唯一值、欄位去key

--model

/app/SolutionTitleModel.php

/app/SolutionTitleLangModel.php

/app/SolutionApplicationModel.php

/app/SolutionApplicationLangModel.php

/app/SolutionServiceModel.php

/app/SolutionServiceLangModel.php

/app/ProductLangModel.php

/app/AboutHistoryTitleModel.php

/app/AboutHistoryTitleLangModel.php

--controller

/app/Http/Controllers/Backend/ProductController.php

/app/Http/Controllers/Backend/SolutionController.php

/app/Http/Controllers/Backend/AboutController.php

/app/Http/Controllers/Frontend/MainController.php

--view

/resources/views/backend/product/edit.blade.php

/resources/views/backend/product/add.blade.php

/resources/views/backend/shared/_nav.blade.php

/resources/views/backend/solution/title.blade.php

/resources/views/backend/about/history_title.blade.php

/resources/views/backend/solution/editapplication.blade.php

/resources/views/backend/solution/service.blade.php

/resources/views/backend/solution/application.blade.php

/resources/views/frontend/solution.blade.php

/resources/views/frontend/index.blade.php

/resources/views/frontend/product.blade.php

/resources/views/frontend/about.blade.php

/resources/views/frontend/shared/_header.blade.php

/resources/views/frontend/shared/_css.blade.php

--public

/public/frontend/images/sprite-2x.png

/public/frontend/images/sprite.png

/public/frontend/images/sprite/icon_download-2x.png

/public/frontend/images/sprite/icon_download.png

--style

/public/frontend/styles/main.css

--route

/routes/web.php

## 2020-01-14

### Changed

- slide fix https

/resources/views/frontend/index.blade.php

/resources/views/frontend/solution.blade.php

## 2020-01-03

### Changed

- 刪除資料時會刪除上傳的檔案夾

/app/Http/Controllers/Backend/AboutController.php

/app/Http/Controllers/Backend/BannerController.php

/app/Http/Controllers/Backend/BlogController.php

/app/Http/Controllers/Backend/ProductController.php

/app/Http/Controllers/Backend/SolutionController.php

/app/Http/Controllers/Backend/Homepage/Content2Controller.php

## 2019-12-27

### Changed

- 編輯器功能全開

/resources/views/backend/about/addhistory.blade.php

/resources/views/backend/about/edithistory.blade.php

/resources/views/backend/banner/edit.blade.php

/resources/views/backend/blog/add.blade.php

/resources/views/backend/blog/edit.blade.php

/resources/views/backend/contact/edit.blade.php

/resources/views/backend/contact/email/edit.blade.php

/resources/views/backend/contact/mail/edit.blade.php

/resources/views/backend/homepage/content1/edit.blade.php

/resources/views/backend/homepage/content2/edit.blade.php

/resources/views/backend/homepage/content3/edit.blade.php

/resources/views/backend/homepage/content4/edit.blade.php

/resources/views/backend/privacy/index.blade.php

/resources/views/backend/product/add.blade.php

/resources/views/backend/product/edit.blade.php

/resources/views/backend/solution/editcontent.blade.php

/resources/views/backend/term/index.blade.php

## 2019-12-26

### Changed

- 更改刪除圖片function

/app/Http/Controllers/Backend/ProductController.php

/app/Http/Controllers/Backend/BlogController.php

- 更改條款後台

/app/Http/Controllers/Backend/PrivacyController.php

/app/Http/Controllers/Frontend/MainController.php

/resources/views/backend/privacy/index.blade.php

/resources/views/backend/shared/_nav.blade.php

/resources/views/frontend/privacy.blade.php

/resources/views/backend/term/index.blade.php

---刪除檔案

/app/PrivacyTermLangModel.php

/app/PrivacyTermModel.php

/resources/views/backend/privacy/term/add.blade.php

/resources/views/backend/privacy/term/edit.blade.php

/resources/views/backend/privacy/term/index.blade.php

## 2019-12-23 2

### Changed

- 連結修正

routes/web.php

- 修改後台menu連結

resources/views/backend/shared/_nav.blade.php

- 修改條款頁面出錯

app/Http/Controllers/Backend/TermController.php

- 刪除會刪除圖片

app/Http/Controllers/Backend/AboutController.php

app/Http/Controllers/Backend/BannerController.php

app/Http/Controllers/Backend/BlogController.php

app/Http/Controllers/Backend/ProductController.php

app/Http/Controllers/Backend/SolutionController.php

app/Http/Controllers/Backend/Homepage/Content2Controller.php

app/Http/Controllers/Backend/Homepage/Content4Controller.php

## 2019-12-23 1

### Changed

- 新增條款後台

app/Http/Controllers/Backend/TermController.php

app/TermLangModel.php

app/TermModel.php

resources/views/backend/term  (整個資料夾)

- 匯入SQL檔

tb_term.sql

- 前台顯示

app/Http/Controllers/Frontend/MainController.php

resources/views/frontend/term.blade.php

resources/views/frontend/shared/_footer.blade.php

- 連結修正

routes/web.php

- 修正後台內文4頁面

resources/views/backend/homepage/content4/edit.blade.php

- 修改後台menu連結

resources/views/backend/shared/_nav.blade.php

- 刪除會刪除圖片

app/Http/Controllers/Backend/AboutController.php

app/Http/Controllers/Backend/BannerController.php

app/Http/Controllers/Backend/BlogController.php

app/Http/Controllers/Backend/ProductController.php

app/Http/Controllers/Backend/SolutionController.php

app/Http/Controllers/Backend/Homepage/Content2Controller.php


## 2019-12-18

### Changed
- url::route使用https並非http-forceScheme在laravel5.4後更換名稱
- 後台圖片上傳會刪除原本圖片

## 2019-11-21

### Changed

- SEO優化
- Solution頁> Key Features 要有圖片更換功能
- 關於我們>新增沿革的排序，刪除排序1之後，排序從2~結束，沒有1
- 後台首頁編輯
- 聯絡我們區域要可編輯-換信箱、地址
- 後台要有可設定同步收件Mail的功能
- 可新增編輯刪除多組收件信箱
- 後台可收信與回復Mail
- 後台要可以更新隱私權政策
- 上傳圖片
