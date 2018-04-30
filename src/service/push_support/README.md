# push_support

プッシュ配信支援システムのWebUIを想定したサンプル。
ビジネスロジック以外の実現性を検討するための実装。

- 環境構築
1. phpMyAdminを使用し、pusu_supportという名前でDBを作成する
1. 必要であればユーザーを作成し、適切な権限設定を行う
1. sqlフォルダにある.sqlファイルの中身をphpMyAdminのコンソールから実行する
1. user_infoに管理者ユーザーを登録する
   ```
   INSERT INTO `user_info` (`user_id`, `user_name`, `pass_word`, `regist_datetime`, `update_datetime`) VALUES (NULL, 'admin', 'admin', '2017-07-15 00:00:00', NULL);
   ```
1. setting_infoにレコードを登録する
   ```
   INSERT INTO `setting_info` (`morning_time`, `day_time`, `night_time`, `enable_android`, `enable_ios`) VALUES ('09:00:00', '12:00:00', '21:00:00', '1', '1');
   ```

