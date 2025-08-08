<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Insurance & MLM Platform</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: #2563eb; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .stat { font-size: 2rem; font-weight: bold; color: #2563eb; }
        .nav { background: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .nav a { text-decoration: none; color: #2563eb; margin-right: 20px; font-weight: 500; }
        .nav a:hover { text-decoration: underline; }
        .btn { background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👋 Welcome, {{ auth()->user()->name }}!</h1>
            <p>Your Insurance & MLM Dashboard</p>
        </div>

        <div class="nav">
            <a href="{{ route('user.index') }}">Dashboard</a>
            <a href="{{ route('user.insurance-packages') }}">Insurance Packages</a>
            <a href="{{ route('user.my-policies') }}">My Policies</a>
            <a href="{{ route('user.mlm-network') }}">MLM Network</a>
            <a href="{{ route('user.commissions') }}">Commissions</a>
            <a href="{{ route('user.ai-advisor') }}">AI Advisor</a>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h3>📋 Insurance Policies</h3>
                <div class="stat">{{ $policies->count() }}</div>
                <p>Active policies in your account</p>
                <a href="{{ route('user.my-policies') }}" class="btn">View Policies</a>
            </div>

            <div class="card">
                <h3>💰 Total Commissions</h3>
                <div class="stat">${{ number_format($totalCommissions, 2) }}</div>
                <p>Total earned from your network</p>
                <small>Pending: ${{ number_format($pendingCommissions, 2) }}</small>
            </div>

            <div class="card">
                <h3>👥 Direct Referrals</h3>
                <div class="stat">{{ $directReferrals }}</div>
                <p>People you've directly referred</p>
                <a href="{{ route('user.mlm-network') }}" class="btn">Build Network</a>
            </div>

            <div class="card">
                <h3>🌟 Current Rank</h3>
                <div class="stat">
                    {{ $currentRank ? $currentRank->rank->name : 'Starter' }}
                </div>
                <p>Your current MLM rank</p>
                <a href="{{ route('user.ai-advisor') }}" class="btn">Get Advice</a>
            </div>

            <div class="card">
                <h3>📊 Network Size</h3>
                <div class="stat">{{ $totalNetworkSize }}</div>
                <p>Total people in your network</p>
            </div>

            <div class="card">
                <h3>🛡️ Quick Actions</h3>
                <p>Get started with your insurance journey</p>
                <a href="{{ route('user.insurance-packages') }}" class="btn">Buy Insurance</a>
                <button class="btn" onclick="dailyCheckIn()" style="margin-left: 10px;">Daily Check-in</button>
            </div>
        </div>

        @if($policies->count() > 0)
        <div class="card" style="margin-top: 20px;">
            <h3>📋 Recent Policies</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #eee;">
                        <th style="text-align: left; padding: 10px;">Policy Number</th>
                        <th style="text-align: left; padding: 10px;">Type</th>
                        <th style="text-align: left; padding: 10px;">Status</th>
                        <th style="text-align: left; padding: 10px;">Premium</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($policies->take(5) as $policy)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px;">{{ $policy->policy_number }}</td>
                        <td style="padding: 10px;">{{ ucfirst($policy->package->type) }}</td>
                        <td style="padding: 10px;">
                            <span style="background: {{ $policy->status == 'active' ? '#10b981' : '#f59e0b' }}; color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">
                                {{ ucfirst($policy->status) }}
                            </span>
                        </td>
                        <td style="padding: 10px;">${{ number_format($policy->premium_amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <script>
        function dailyCheckIn() {
            fetch('{{ route("user.daily-checkin") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                alert('Check-in successful! You earned ' + data.discount_earned + '% discount on your next premium!');
            })
            .catch(error => {
                alert('Check-in failed. Please try again.');
            });
        }
    </script>
</body>
</html>