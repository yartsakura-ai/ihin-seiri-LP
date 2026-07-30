# ihin-seiri-LP

横浜市で活動する遺品整理サービスの区別LPを、今後制作・管理するためのリポジトリです。

現時点では、LP本文やサンプルページはまだ作らず、GitHub、Codex、Claude Codeを連携しやすくするための土台だけを置いています。

## 役割分担

- GitHub: 変更履歴、Issue、Pull Request、Claude Code実行の中心
- Codex: LP構成、実装、ファイル作成、GitHubへ反映する作業担当
- Claude Code: PR上での文章レビュー、表現改善、重複チェック担当

## 初期構成

```text
AGENTS.md
CLAUDE.md
.github/workflows/claude.yml
docs/launch-checklist.md
```

## GitHub Desktopでやること

1. 変更内容を確認する
2. commit message に `Setup Codex and Claude integration` と入れる
3. `Commit to main`
4. 未公開なら `Publish repository`
5. 公開設定は Private のままにする

## Claude Codeを使うために必要なこと

GitHubのWeb画面で、以下のSecretを登録します。

```text
ANTHROPIC_API_KEY
```

場所:

```text
Repository Settings
-> Secrets and variables
-> Actions
-> New repository secret
```

登録後、IssueやPull Requestで `@claude` とコメントすると、Claude CodeのGitHub Actions連携を使えるようになります。

## biz-kaishu LP（店舗・事業者向け不用品回収）

`docs/biz-kaishu/` に、リサイクルショップ・店舗・倉庫などの事業者向けに、売れ残り在庫や什器の有料回収を案内する広告LPを追加しました。

- 仮公開URL: https://yartsakura-ai.github.io/ihin-seiri-LP/biz-kaishu/
- 画像: `docs/assets/images/biz-kaishu/`（モザイク処理済みWebP。処理内容は同フォルダの `IMAGE-MANIFEST.md` を参照）
- 問い合わせ導線: 電話・LINE・メール（メールは `y.artsakura@gmail.com`、独自ドメイン取得後に変更予定）
- ステータス: GitHub Pagesで仮公開中。試作段階のため `noindex,nofollow` を設定中。
- 許認可表示: 古物商許可証番号は `451930009599号` を掲載。産業廃棄物収集運搬業許可番号は、正式番号確認後に追記する前提で `正式番号確認後に記載` と表示。
- 料金目安: 1立米あたり税込10,000円を基本に、品目・物量・搬出状況で案内。少量回収は物量に応じて算出し、現地訪問時の運搬費は事前案内。
- 正式公開前の確認: 産業廃棄物収集運搬業許可番号を正式番号へ差し替え、検索流入を開始する場合は `noindex,nofollow` を解除する。
