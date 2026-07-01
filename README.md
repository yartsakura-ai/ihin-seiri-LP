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
