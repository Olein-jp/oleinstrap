# oleinstrap
受託案件用に作った、個人的に「このコードはほぼ使うでしょ」的なものを盛り込んだものです。ですので「案件によっては使わない」というコードに関しては入れないように努力しました。

## 使い方
まずは`gulpfile.js`の`dev.wordpress`をよしなの開発環境設定に合わせてください。

そして、`npm install`で諸々パッケージをインストールします。これで基本的に準備完了です。

## 開発作業

```$xslt
npm run start
```

これで`gulpfile.js`で設定してあるgulp環境が立ち上がります。

## ビルド

### タスクランナー

```$xslt
npm run build
```

一度、`assets`ディレクトリ内をクリーンにして、パッケージングします。詳細は`gulpfile.js`を確認してください。

### ビルドブロック

```
npm run build-blocks
```

`inc/blocks/index.php`と`inc/blocks/src`にあるJS、Sassファイルをコンパイルして`inc/blocks/build`に書き出します。

処理の詳細は`package.json`を確認してください。

## 構造
```
/assets //公開用アセット
    /images
    /css
        /maps
        editor-style.css
        editor-sty;e.min.css
        front-style.css
        front-style.min.css
    /js
        index.js
        index.min.js
    /vendor // npmで管理しているパッケージの公開用データ
        /hamburgers
        /slick
        /superfish
/src //開発用
    /assets 開発用アセット
        /images //imageminされて `asets/images' へ
        /js 
            index.js
        /sass
            /base     // 基本設定
                base.scss
                _elements.scss
                _html5doctor-reset.scss
                _normalize.scss
            /blocks   // ブロックのスタイル上書き用
                /core
                    _button.scss
                    _columns.scss
                    _cover.scss
                    _image.scss
                    _media-text.scss
                    _table.scss
                    core.scss
                _originals.scss
                blocks.scss
            /settings // メディアクエリ・変数など
                _mediaquery.scss
                _variables.scss
                settings.scss
            /smaccs   // SMACCS記法で
                _layout.scss
                _module.scss
                _state.scss
                _theme.scss
                smaccs.scss
            /tools    // mixin管理
                _mixin.scss
                tools.scss
            /utility  // ユーティリティ管理
                _a11y.scss
                _alignment.scss
                _color.scss
                _fontsize.scss
                _helper.scss
                _media.scss
                utility.scss
            /vendor   // 利用するパッケージのスタイル
            editor-style.scss
            front-style.scss
        /vendor
            /hamburgers
            /slick
            /superfish
/inc
    /blocks
        index.php
        /src
            index.js // コンパイルされて build へ
            style.scss // コンパイルされて build へ
        /build
            index.js
            style.css
            index.asset.php
_front-page.php
footer.php
functions.php
gulpfile.js
header.php
home.php
imagemin.js
package.json
postcss.config.js
single.php
style.css
```
