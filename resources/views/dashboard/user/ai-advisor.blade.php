<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Advisor - Insurance & MLM Platform</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .nav { background: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .nav a { text-decoration: none; color: #6366f1; margin-right: 20px; font-weight: 500; }
        .chat-container { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; }
        .chat-header { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; padding: 20px; text-align: center; }
        .chat-messages { padding: 20px; height: 400px; overflow-y: auto; border-bottom: 1px solid #e5e7eb; }
        .message { margin-bottom: 15px; display: flex; align-items: flex-start; }
        .message.ai { flex-direction: row; }
        .message.user { flex-direction: row-reverse; }
        .message-content { max-width: 70%; padding: 12px 16px; border-radius: 18px; line-height: 1.4; }
        .message.ai .message-content { background: #f3f4f6; color: #1f2937; margin-left: 10px; }
        .message.user .message-content { background: #6366f1; color: white; margin-right: 10px; }
        .message-avatar { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .message.ai .message-avatar { background: #6366f1; color: white; }
        .message.user .message-avatar { background: #10b981; color: white; }
        .chat-input { padding: 20px; display: flex; gap: 10px; }
        .chat-input input { flex: 1; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 16px; }
        .chat-input button { padding: 12px 20px; background: #6366f1; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; }
        .chat-input button:hover { background: #5046e4; }
        .suggestions { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-bottom: 20px; }
        .suggestion-card { background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); cursor: pointer; transition: transform 0.2s; }
        .suggestion-card:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🤖 AI Insurance & MLM Advisor</h1>
            <p>Get personalized advice to maximize your earnings and optimize your insurance coverage</p>
        </div>

        <div class="nav">
            <a href="{{ route('user.index') }}">← Back to Dashboard</a>
            <a href="{{ route('user.mlm-network') }}">MLM Network</a>
            <a href="{{ route('user.commissions') }}">Commissions</a>
        </div>

        <div class="suggestions">
            @foreach($suggestions as $suggestion)
            <div class="suggestion-card" onclick="askQuestion('{{ addslashes($suggestion) }}')">
                <strong>💡 Suggestion:</strong><br>
                {{ $suggestion }}
            </div>
            @endforeach
        </div>

        <div class="chat-container">
            <div class="chat-header">
                <h3>🤖 Your Personal AI Advisor</h3>
                <p>Ask me anything about insurance, MLM strategies, or commission optimization!</p>
            </div>
            
            <div class="chat-messages" id="chatMessages">
                <div class="message ai">
                    <div class="message-avatar">🤖</div>
                    <div class="message-content">
                        Hi {{ auth()->user()->name }}! I'm your AI advisor. I can help you with:
                        <ul style="margin: 10px 0; padding-left: 20px;">
                            <li>Insurance coverage recommendations</li>
                            <li>MLM network building strategies</li>
                            <li>Commission optimization tips</li>
                            <li>Rank advancement guidance</li>
                            <li>Premium discount opportunities</li>
                        </ul>
                        What would you like to know?
                    </div>
                </div>
            </div>
            
            <div class="chat-input">
                <input type="text" id="messageInput" placeholder="Ask me anything about insurance or MLM..." onkeypress="handleKeyPress(event)">
                <button onclick="sendMessage()">Send</button>
            </div>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-top: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h3>📊 Your Current Status</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div style="text-align: center; padding: 15px; background: #f9fafb; border-radius: 8px;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #6366f1;">{{ auth()->user()->insurancePolicies->count() }}</div>
                    <div style="color: #6b7280;">Active Policies</div>
                </div>
                <div style="text-align: center; padding: 15px; background: #f9fafb; border-radius: 8px;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #10b981;">${{ number_format(auth()->user()->commission_balance, 2) }}</div>
                    <div style="color: #6b7280;">Commission Balance</div>
                </div>
                <div style="text-align: center; padding: 15px; background: #f9fafb; border-radius: 8px;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #f59e0b;">{{ auth()->user()->referrals->count() }}</div>
                    <div style="color: #6b7280;">Direct Referrals</div>
                </div>
                <div style="text-align: center; padding: 15px; background: #f9fafb; border-radius: 8px;">
                    <div style="font-size: 1.5rem; font-weight: bold; color: #8b5cf6;">
                        {{ auth()->user()->currentRank ? auth()->user()->currentRank->rank->name : 'Starter' }}
                    </div>
                    <div style="color: #6b7280;">Current Rank</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function askQuestion(question) {
            document.getElementById('messageInput').value = question;
            sendMessage();
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }

        function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();
            if (!message) return;

            // Add user message to chat
            addMessage(message, 'user');
            input.value = '';

            // Generate AI response
            setTimeout(() => {
                const aiResponse = generateAIResponse(message);
                addMessage(aiResponse, 'ai');
            }, 1000);
        }

        function addMessage(content, sender) {
            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${sender}`;
            
            const avatar = document.createElement('div');
            avatar.className = 'message-avatar';
            avatar.textContent = sender === 'ai' ? '🤖' : '👤';
            
            const messageContent = document.createElement('div');
            messageContent.className = 'message-content';
            messageContent.innerHTML = content;
            
            messageDiv.appendChild(avatar);
            messageDiv.appendChild(messageContent);
            chatMessages.appendChild(messageDiv);
            
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function generateAIResponse(message) {
            const responses = {
                'insurance': "Based on your current situation, I recommend considering additional coverage. With {{ auth()->user()->referrals->count() }} referrals, you're earning good commissions! Consider upgrading to our premium packages to maximize your earning potential.",
                'rank': "To advance to the next rank, you need {{ 10 - auth()->user()->referrals->count() }} more direct referrals. Focus on sharing your success story and the benefits of our platform. Each new referral brings you closer to higher monthly bonuses!",
                'commission': "Your current commission balance is ${{ number_format(auth()->user()->commission_balance, 2) }}. To increase earnings, focus on: 1) Recruiting more direct referrals (5% commission each), 2) Building your binary team depth, 3) Helping your referrals succeed.",
                'discount': "Great question! You can reduce your premiums by up to 15% through: 1) Daily check-ins for safe driving/healthy habits, 2) Loyalty discounts (1% per month of membership), 3) Rank bonuses for higher-tier members.",
                'network': "To build your network effectively: 1) Share your referral code on social media, 2) Host virtual information sessions, 3) Follow up with prospects regularly, 4) Lead by example with good insurance habits, 5) Help your referrals get started successfully."
            };

            // Simple keyword matching for demo purposes
            const lowerMessage = message.toLowerCase();
            for (const [keyword, response] of Object.entries(responses)) {
                if (lowerMessage.includes(keyword)) {
                    return response;
                }
            }

            // Default response
            return "That's a great question! Based on your current profile with {{ auth()->user()->referrals->count() }} referrals and ${{ number_format(auth()->user()->commission_balance, 2) }} commission balance, I'd recommend focusing on expanding your network. Each new referral brings 5% commission and helps build your binary team. Would you like specific strategies for network growth?";
        }
    </script>
</body>
</html>