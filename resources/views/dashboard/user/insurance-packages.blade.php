<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Packages - Insurance & MLM Platform</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: #2563eb; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .packages-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 20px; }
        .package-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.2s; }
        .package-card:hover { transform: translateY(-2px); }
        .package-header { padding: 20px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
        .package-body { padding: 20px; }
        .price { font-size: 2rem; font-weight: bold; color: #2563eb; }
        .feature-list { list-style: none; padding: 0; margin: 15px 0; }
        .feature-list li { padding: 8px 0; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; }
        .feature-list li:before { content: "✓"; color: #10b981; font-weight: bold; margin-right: 10px; }
        .btn { background: #2563eb; color: white; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: 500; text-align: center; width: 100%; }
        .btn:hover { background: #1d4ed8; }
        .nav { background: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .nav a { text-decoration: none; color: #2563eb; margin-right: 20px; font-weight: 500; }
        .nav a:hover { text-decoration: underline; }
        .badge { background: #fbbf24; color: #92400e; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛡️ Insurance Packages</h1>
            <p>Choose the perfect insurance plan for your needs</p>
        </div>

        <div class="nav">
            <a href="{{ route('user.index') }}">← Back to Dashboard</a>
            <a href="{{ route('user.my-policies') }}">My Policies</a>
            <a href="{{ route('user.ai-advisor') }}">Get AI Advice</a>
        </div>

        <div class="packages-grid">
            @forelse($packages as $package)
            <div class="package-card">
                <div class="package-header">
                    <h3>{{ $package->name }}</h3>
                    <p>{{ ucfirst($package->type) }} Insurance</p>
                    @if($package->type == 'car')
                        <span style="font-size: 2rem;">🚗</span>
                    @elseif($package->type == 'health')
                        <span style="font-size: 2rem;">🏥</span>
                    @elseif($package->type == 'life')
                        <span style="font-size: 2rem;">👨‍👩‍👧‍👦</span>
                    @elseif($package->type == 'home')
                        <span style="font-size: 2rem;">🏠</span>
                    @else
                        <span style="font-size: 2rem;">✈️</span>
                    @endif
                </div>
                
                <div class="package-body">
                    <div class="price">${{ number_format($package->base_premium, 2) }}</div>
                    <small style="color: #6b7280;">per month</small>
                    
                    <p style="margin: 15px 0; color: #4b5563;">{{ $package->description }}</p>
                    
                    <div style="background: #f9fafb; padding: 15px; border-radius: 8px; margin: 15px 0;">
                        <strong>Coverage Amount:</strong> ${{ number_format($package->coverage_amount, 2) }}<br>
                        <strong>Deductible:</strong> ${{ number_format($package->deductible, 2) }}
                    </div>

                    @if($package->terms && count($package->terms) > 0)
                    <h4>What's Included:</h4>
                    <ul class="feature-list">
                        @foreach(array_slice($package->terms, 0, 4) as $term)
                        <li>{{ $term }}</li>
                        @endforeach
                    </ul>
                    @endif

                    @if($package->required_fields && count($package->required_fields) > 0)
                    <div style="background: #fef3c7; padding: 10px; border-radius: 8px; margin: 15px 0; border-left: 4px solid #f59e0b;">
                        <strong>Required Information:</strong><br>
                        <small>{{ implode(', ', array_slice($package->required_fields, 0, 3)) }}</small>
                    </div>
                    @endif

                    <div style="margin-top: 20px;">
                        <span class="badge">{{ $package->policies_count ?? 0 }} customers</span>
                        <span class="badge" style="margin-left: 10px;">Earn 5% commission</span>
                    </div>

                    <a href="{{ route('insurance.show', $package) }}" class="btn" style="margin-top: 20px;">
                        Learn More & Purchase
                    </a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
                <h3>No Insurance Packages Available</h3>
                <p>Please check back later or contact an administrator.</p>
            </div>
            @endforelse
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-top: 20px; text-align: center;">
            <h3>🎯 Why Choose Our Insurance?</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                <div>
                    <span style="font-size: 2rem;">💰</span>
                    <h4>Earn Commissions</h4>
                    <p>Get 5% commission for every referral plus binary tree bonuses</p>
                </div>
                <div>
                    <span style="font-size: 2rem;">📱</span>
                    <h4>Easy Claims</h4>
                    <p>Submit claims instantly with photo uploads and track status in real-time</p>
                </div>
                <div>
                    <span style="font-size: 2rem;">🎯</span>
                    <h4>Premium Discounts</h4>
                    <p>Daily check-ins and safety scores can reduce your premiums by up to 15%</p>
                </div>
                <div>
                    <span style="font-size: 2rem;">🤖</span>
                    <h4>AI Advisor</h4>
                    <p>Get personalized advice on coverage, savings, and network building</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>