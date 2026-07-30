# LP image manifest — realty-zanchibutsu

不動産会社向け残置物撤去LP用の画像記録です。元画像は変更していません。すべてリポジトリ内の既存画像からのコピーです（リポジトリ外からの取り込みなし）。

ginza系・ihin系WebPは、コピー元 `docs/assets/images/biz-kaishu/` の時点で顔・車両ナンバーへのぼかし処理が適用済みです（`docs/assets/images/biz-kaishu/IMAGE-MANIFEST.md` 参照）。今回の作業で新たなぼかし・モザイク処理は行っていません。

**正式公開前に、人による最終目視確認が必要です。**

| 元画像（リポジトリ内） | Web画像名 | 出力サイズ | 変換 | 採用理由 |
|---|---|---:|---|---|
| `docs/assets/images/kazai-seiri-clutter-room.jpg` | `kazai-seiri-clutter-room.jpg` | 1600x2133 | コピーのみ | ファーストビュー。家具・書籍・段ボールが残る居室＝残置物物件の代表例 |
| `docs/assets/images/tsuzuki-ad/hero-before.jpg` | `hero-before.jpg` | 1600x1200 | コピーのみ | 住宅の作業前（BEFORE/AFTER事例1） |
| `docs/assets/images/tsuzuki-ad/hero-after.jpg` | `hero-after.jpg` | 1600x1200 | コピーのみ | 住宅の作業後（BEFORE/AFTER事例1） |
| `docs/assets/images/biz-kaishu/ginza-img-0159.webp` | `ginza-img-0159.webp` | 1600x2133 | コピーのみ | 事務所の作業前（BEFORE/AFTER事例2） |
| `docs/assets/images/biz-kaishu/ginza-326c2926.webp` | `ginza-326c2926.webp` | 1108x1477 | コピーのみ | 事務所の作業後（BEFORE/AFTER事例2） |
| `docs/assets/images/biz-kaishu/ginza-img-0154.webp` | `ginza-img-0154.webp` | 1600x2133 | コピーのみ | 事務所の作業前（BEFORE/AFTER事例3） |
| `docs/assets/images/biz-kaishu/ginza-979b236a.webp` | `ginza-979b236a.webp` | 1108x1477 | コピーのみ | 事務所の作業後（BEFORE/AFTER事例3） |
| `docs/assets/images/biz-kaishu/ihin-img-2784.webp` | `ihin-img-2784.webp` | 1600x1200 | コピーのみ | 搬出・積み込み作業の様子（流れセクション） |
| `docs/assets/images/biz-kaishu/ihin-img-1780-masked.webp` | `ihin-img-1780-masked.webp` | 1600x2133 | コピーのみ | 軽トラックへの少量積み込み（相談例セクション）。マスク済み派生版を採用 |
| `docs/assets/images/akiya-seiri-empty-room.jpg` | `akiya-seiri-empty-room.jpg` | 1600x2133 | コピーのみ | 搬出後の空室（最終CTA付近の視覚材料） |
| `docs/assets/images/tsuzuki-ad/art-sakura-header-logo.png` | `art-sakura-header-logo.png` | 621x430 | コピーのみ | ヘッダーロゴ |
| `docs/assets/images/biz-kaishu/line-qr-rgba.png` | `line-qr-rgba.png` | 300x300 | コピーのみ | 会社情報のLINE QRコード |
| `docs/assets/images/tsuzuki-ad/hero-before.jpg` | `og-realty-zanchibutsu.jpg` | 1200x630 | 中央帯を切り出し（元1600x1200の y180〜y1020）→1200x630へ縮小、JPEG品質82 | OGP画像。残置物のある室内で、サービス内容が一目で伝わるため |

## プライバシー確認（AIによる目視。正式公開前に人の確認が必要）

- `kazai-seiri-clutter-room.jpg`: 顔・ナンバー・表札・判読可能な書類・家族写真なし
- `hero-before.jpg`: 顔・ナンバー・表札なし。段ボールに引越会社の既製印字あり（個人情報ではない）
- `hero-after.jpg`: 空室。問題なし
- `ginza-img-0159.webp`: 顔・ナンバーなし。書類の山は判読不可。青果箱の既製印字のみ
- `ginza-326c2926.webp`: 空室。問題なし
- `ginza-img-0154.webp`: 顔・ナンバー・書類なし
- `ginza-979b236a.webp`: 空室。問題なし
- `ihin-img-2784.webp`: 人物の顔・背景車両ナンバーはコピー元でぼかし済みであることを確認
- `ihin-img-1780-masked.webp`: 車両ナンバーはコピー元でぼかし済みであることを確認
- `akiya-seiri-empty-room.jpg`: 顔・ナンバー・表札なし
- `og-realty-zanchibutsu.jpg`: `hero-before.jpg` の切り出しのため同様に問題なし

## 不採用の記録

- `docs/assets/images/case2-before.jpg`: 冷蔵庫に子どもの写真（私的な家族写真）が映っているため不採用。対の `case2-after.jpg` も未使用
