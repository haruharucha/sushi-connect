<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予約完了のお知らせ</title>
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e9e9e9; border-radius: 5px; }
        .header { background-color: #2c3e50; color: #fff; padding: 15px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .info-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .info-table th, .info-table td { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
        .info-table th { width: 30%; background-color: #f8f9fa; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>すしコネクト</h2>
    </div>
    
    <div class="content">
        <p>※このメールはシステムからの自動配信です。</p>
        <p>ご予約が確定いたしました。ご来店を心よりお待ちしております。</p>
        
        <h3>■ 予約内容</h3>
        <table class="info-table">
            <tr>
                <th>店名</th>
                <td><strong>{{ $reservation->shop->name }}</strong></td>
            </tr>
            <tr>
                <th>予約日時</th>
                <td>{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('Y年m月d日 H:i') }}</td>
            </tr>
            <tr>
                <th>人数</th>
                <td>{{ $reservation->number_of_people }} 名様</td>
            </tr>
        </table>
        
        <p style="margin-top: 20px;">万が一キャンセルや変更がある場合は、アプリのマイページよりお手続きをお願いいたします。</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} すしコネクト All Rights Reserved.</p>
    </div>
</div>

</body>
</html>