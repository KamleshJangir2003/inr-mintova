<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptocurrency Trading Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #0a0e17;
            color: #ffffff;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #131a2a;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .header {
            padding: 20px;
            border-bottom: 1px solid #1e293b;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .time-filters {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .time-filter {
            background-color: #1e293b;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .time-filter.active {
            background-color: #3b82f6;
        }
        
        .divider {
            height: 1px;
            background-color: #1e293b;
            margin: 15px 0;
        }
        
        .price-section {
            padding: 20px;
        }
        
        .current-price {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .price-change {
            display: flex;
            align-items: center;
            color: #10b981;
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        .price-change.up {
            color: #10b981;
        }
        
        .price-change.down {
            color: #ef4444;
        }
        
        .exchange-rate {
            background-color: #1e293b;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        .trade-section {
            padding: 20px;
        }
        
        .trade-option {
            background-color: #1e293b;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        
        .trade-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .trade-title {
            font-size: 16px;
            font-weight: 500;
        }
        
        .trade-arrows {
            display: flex;
            gap: 10px;
        }
        
        .arrow {
            width: 24px;
            height: 24px;
            background-color: #334155;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .trade-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .currency {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .currency-icon {
            width: 24px;
            height: 24px;
            background-color: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .currency-name {
            font-size: 16px;
            font-weight: 500;
        }
        
        .news-section {
            padding: 20px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .news-item {
            background-color: #1e293b;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        
        .news-date {
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .news-title {
            font-size: 16px;
            font-weight: 500;
        }
        
        .rewards-section {
            padding: 20px;
        }
        
        .reward-item {
            background-color: #1e293b;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        
        .reward-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .reward-amount {
            color: #10b981;
            font-size: 14px;
        }
        
        .bonus-item {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        
        .bonus-title {
            font-size: 16px;
            font-weight: 500;
        }
        
        .promo-section {
            padding: 20px;
        }
        
        .promo-item {
            background-color: #1e293b;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        
        .promo-title {
            font-size: 16px;
            font-weight: 500;
        }
        
        .trading-section {
            padding: 20px;
        }
        
        .trading-item {
            background-color: #1e293b;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        
        .upgrade-item {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        
        .upgrade-title {
            font-size: 16px;
            font-weight: 500;
        }
        
        .logout-section {
            padding: 20px;
        }
        
        .logout-item {
            background-color: #1e293b;
            padding: 16px;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>BTC/USD</h1>
            <div class="time-filters">
                <div class="time-filter">Boy</div>
                <div class="time-filter active">Week</div>
                <div class="time-filter">Month</div>
                <div class="time-filter">Year</div>
            </div>
        </div>
        
        <div class="divider"></div>
        
        <div class="price-section">
            <div class="current-price">16,430.00 USD</div>
            <div class="price-change up">↑ 24143 USD (+ 102%)</div>
            
            <div class="current-price">24,845.36 USD</div>
            <div class="price-change up">↑ 93112 USD</div>
            
            <div class="exchange-rate">1 BTC = 30,834.00 USD</div>
        </div>
        
        <div class="trade-section">
            <div class="trade-option">
                <div class="trade-header">
                    <div class="trade-title">You sell</div>
                    <div class="trade-arrows">
                        <div class="arrow">↑</div>
                        <div class="arrow">↓</div>
                    </div>
                </div>
                <div class="trade-details">
                    <div class="currency">
                        <div class="currency-icon">B</div>
                        <div class="currency-name">BTC</div>
                    </div>
                    <div class="currency-direction">↘</div>
                </div>
            </div>
            
            <div class="trade-option">
                <div class="trade-header">
                    <div class="trade-title">You get</div>
                    <div class="trade-arrows">
                        <div class="arrow">↑</div>
                        <div class="arrow">↓</div>
                    </div>
                </div>
                <div class="trade-details">
                    <div class="currency">
                        <div class="currency-icon">U</div>
                        <div class="currency-name">USD</div>
                    </div>
                    <div class="currency-direction">↘</div>
                </div>
            </div>
            
            <div class="trade-option">
                <div class="trade-header">
                    <div class="trade-title">Exchange</div>
                    <div class="trade-arrows">
                        <div class="arrow">↑</div>
                        <div class="arrow">↓</div>
                    </div>
                </div>
                <div class="trade-details">
                    <div class="currency">
                        <div class="currency-icon">B</div>
                        <div class="currency-name">BTC</div>
                    </div>
                    <div class="currency-direction">↘</div>
                </div>
            </div>
        </div>
        
        <div class="news-section">
            <div class="section-title">News</div>
            <div class="news-item">
                <div class="news-date">Today</div>
                <div class="news-title">Challenges to Global Cryptocurrency Adoption</div>
            </div>
        </div>
        
        <div class="rewards-section">
            <div class="section-title">Rewards</div>
            <div class="reward-item">
                <div class="reward-title">Invite a friend using your referral code</div>
                <div class="reward-amount">+0.00 USD</div>
            </div>
            
            <div class="bonus-item">
                <div class="bonus-title">Get your first coin - 50% bonus to your next deposit</div>
            </div>
        </div>
        
        <div class="promo-section">
            <div class="promo-item">
                <div class="promo-title">Make more transactions - Increased cashback</div>
            </div>
            
            <div class="promo-item">
                <div class="promo-title">Make more transactions - Increased cashback</div>
            </div>
            
            <div class="promo-item">
                <div class="promo-title">Take more transactions - Increased cashback</div>
            </div>
        </div>
        
        <div class="trading-section">
            <div class="section-title">Trading</div>
            <div class="trading-item">
                <div class="news-date">Today</div>
                <div class="news-title">What will happen to bitcoin in the coming week</div>
            </div>
            
            <div class="upgrade-item">
                <div class="upgrade-title">Upgrade Now</div>
                <div class="news-date">Yesterday</div>
                <div class="news-title">New tax rules for cryptocurrency</div>
            </div>
        </div>
        
        <div class="logout-section">
            <div class="logout-item">
                <div class="news-date">Yesterday</div>
                <div class="news-title">Should You Buy the Bitcoin?</div>
            </div>
        </div>
    </div>
</body>
</html>