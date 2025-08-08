<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MLM Network - Insurance & MLM Platform</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: #2563eb; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .nav { background: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .nav a { text-decoration: none; color: #2563eb; margin-right: 20px; font-weight: 500; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .referral-code { background: #f0f9ff; border: 2px solid #3b82f6; padding: 20px; border-radius: 12px; text-align: center; margin-bottom: 20px; }
        .code { font-family: monospace; font-size: 1.5rem; font-weight: bold; color: #1d4ed8; letter-spacing: 2px; }
        .network-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .member-card { background: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .member-name { font-weight: bold; color: #1f2937; margin-bottom: 5px; }
        .member-info { font-size: 14px; color: #6b7280; }
        .btn { background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #1d4ed8; }
        .btn-copy { background: #10b981; }
        .btn-copy:hover { background: #059669; }
        .tree-structure { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .tree-node { text-align: center; margin: 10px; padding: 10px; border: 2px solid #e5e7eb; border-radius: 8px; background: #f9fafb; }
        .tree-node.you { border-color: #3b82f6; background: #dbeafe; }
        .tree-node.left { border-color: #10b981; background: #d1fae5; }
        .tree-node.right { border-color: #f59e0b; background: #fef3c7; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👥 MLM Network & Team Building</h1>
            <p>Build your network and earn from your team's success</p>
        </div>

        <div class="nav">
            <a href="{{ route('user.index') }}">← Back to Dashboard</a>
            <a href="{{ route('user.commissions') }}">View Commissions</a>
            <a href="{{ route('user.ai-advisor') }}">Get AI Advice</a>
        </div>

        <div class="referral-code">
            <h3>🎯 Your Referral Code</h3>
            <div class="code">{{ $referralCode }}</div>
            <p>Share this code with others to build your network and earn commissions!</p>
            <button class="btn btn-copy" onclick="copyReferralCode()">Copy Code</button>
            <button class="btn" onclick="shareReferralLink()">Share Link</button>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div class="card">
                <h3>📊 Network Statistics</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                    <div style="text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #2563eb;">{{ $directReferrals->count() }}</div>
                        <div style="color: #6b7280;">Direct Referrals</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #10b981;">{{ $mlmChildren->count() }}</div>
                        <div style="color: #6b7280;">Binary Team</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>🎯 Network Goals</h3>
                <div style="margin-top: 15px;">
                    <div style="margin-bottom: 10px;">
                        <span>Direct Referrals Progress:</span>
                        <div style="background: #f3f4f6; height: 10px; border-radius: 5px; margin-top: 5px;">
                            <div style="background: #3b82f6; height: 100%; width: {{ min(($directReferrals->count() / 10) * 100, 100) }}%; border-radius: 5px;"></div>
                        </div>
                        <small>{{ $directReferrals->count() }}/10 for next rank</small>
                    </div>
                </div>
            </div>
        </div>

        @if($directReferrals->count() > 0)
        <div class="card">
            <h3>👥 Direct Referrals</h3>
            <div class="network-grid">
                @foreach($directReferrals as $member)
                <div class="member-card">
                    <div class="member-name">{{ $member->name }}</div>
                    <div class="member-info">
                        Joined: {{ $member->created_at->format('M d, Y') }}<br>
                        Rank: {{ $member->currentRank ? $member->currentRank->rank->name : 'Starter' }}<br>
                        Referrals: {{ $member->referrals->count() }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($mlmChildren->count() > 0)
        <div class="card">
            <h3>🌳 Binary Team Structure</h3>
            <div class="tree-structure">
                <div style="display: flex; justify-content: center; margin-bottom: 20px;">
                    <div class="tree-node you">
                        <strong>YOU</strong><br>
                        {{ auth()->user()->name }}
                    </div>
                </div>
                
                <div style="display: flex; justify-content: space-around;">
                    <div>
                        <h4 style="text-align: center; color: #10b981;">Left Leg</h4>
                        @foreach($mlmChildren->where('mlm_position', 'left') as $child)
                        <div class="tree-node left">
                            {{ $child->name }}<br>
                            <small>{{ $child->created_at->format('M d, Y') }}</small>
                        </div>
                        @endforeach
                        @if($mlmChildren->where('mlm_position', 'left')->count() == 0)
                        <div class="tree-node" style="border-style: dashed; color: #9ca3af;">
                            Available Position
                        </div>
                        @endif
                    </div>
                    
                    <div>
                        <h4 style="text-align: center; color: #f59e0b;">Right Leg</h4>
                        @foreach($mlmChildren->where('mlm_position', 'right') as $child)
                        <div class="tree-node right">
                            {{ $child->name }}<br>
                            <small>{{ $child->created_at->format('M d, Y') }}</small>
                        </div>
                        @endforeach
                        @if($mlmChildren->where('mlm_position', 'right')->count() == 0)
                        <div class="tree-node" style="border-style: dashed; color: #9ca3af;">
                            Available Position
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="card">
            <h3>🚀 Grow Your Network</h3>
            <p>Here are some tips to expand your network and increase your earnings:</p>
            <ul style="line-height: 1.8;">
                <li><strong>Share your story:</strong> Tell people how insurance has helped you</li>
                <li><strong>Use social media:</strong> Post about your insurance savings and referral code</li>
                <li><strong>Host information sessions:</strong> Invite friends to learn about the platform</li>
                <li><strong>Follow up:</strong> Check in with your referrals and help them succeed</li>
                <li><strong>Lead by example:</strong> Stay active and maintain good insurance habits</li>
            </ul>
            <a href="{{ route('user.ai-advisor') }}" class="btn">Get Personalized Advice</a>
        </div>
    </div>

    <script>
        function copyReferralCode() {
            const code = '{{ $referralCode }}';
            navigator.clipboard.writeText(code).then(function() {
                alert('Referral code copied to clipboard!');
            });
        }

        function shareReferralLink() {
            const url = window.location.origin + '/register?ref={{ $referralCode }}';
            navigator.clipboard.writeText(url).then(function() {
                alert('Referral link copied to clipboard!');
            });
        }
    </script>
</body>
</html>