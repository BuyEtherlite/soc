# 🛡️ Insurance & MLM Platform

A comprehensive Laravel-based platform that combines insurance management with Multi-Level Marketing (MLM) functionality, featuring distinct user roles and advanced business logic.

![Platform Screenshot](https://github.com/user-attachments/assets/f5b9dd92-bfed-42d4-b1a6-96b2f2987118)

## 🚀 Features Overview

### For Regular Users 🧑‍💼
- **Insurance Management**: Purchase and manage car, health, life, home & travel insurance
- **Claims Processing**: Submit claims with document uploads and real-time tracking
- **MLM Network Building**: Binary tree structure with left/right leg placement
- **Commission Tracking**: Real-time earnings from referrals and network activity
- **Premium Discounts**: Daily check-ins and safety scores reduce premiums up to 15%
- **AI Advisor**: Personalized recommendations for coverage and network growth

### For Administrators 👑
- **User Management**: Complete CRUD operations on all platform users
- **Financial Oversight**: Monitor payouts, approve withdrawals, track commission flow
- **Claims Administration**: Review and approve/reject insurance claims
- **System Configuration**: Create insurance packages, manage MLM ranks, tune algorithms
- **Advanced Analytics**: Fraud detection, churn prediction, geospatial claim mapping
- **Business Intelligence**: Risk assessment and platform health monitoring

## 💰 MLM Commission Structure

### Direct Referrals
- **5%** commission on every person you directly refer
- Immediate payout to commission balance
- Tracks through unique referral codes

### Binary Tree Bonuses
- **Level 2**: 3% commission
- **Level 3**: 2% commission  
- **Level 4**: 1% commission
- **Level 5**: 0.5% commission

### Rank System
- **Bronze**: 2 referrals, $50/month salary, 5% bonus
- **Silver**: 5 referrals, $150/month salary, 7.5% bonus
- **Gold**: 10 referrals, $350/month salary, 10% bonus
- **Platinum**: 20 referrals, $750/month salary, 12.5% bonus
- **Diamond**: 50 referrals, $1500/month salary, 15% bonus

## 🏗️ Technical Architecture

### Database Models
- **User**: Extended with role, referral system, MLM hierarchy
- **InsurancePackage**: Configurable insurance products
- **InsurancePolicy**: User policy instances with customizations
- **Claim**: Claims management with approval workflow
- **Commission**: Multi-level commission tracking
- **Rank**: MLM rank system with requirements

### Key Controllers
- **UserDashboardController**: Regular user interface and functionality
- **AdminDashboardController**: Administrative operations and oversight
- **InsuranceController**: Policy purchase and management
- **ClaimController**: Claims submission and processing

### Security Features
- **Role-based access control** with middleware
- **Input validation** and sanitization
- **File upload security** for claim documents
- **Commission calculation safeguards**

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.3+
- Composer
- Laravel 12.x
- SQLite/MySQL database

### Quick Start

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Start Development Server**
   ```bash
   php artisan serve
   ```

5. **Access the Platform**
   - Main site: http://localhost:8000
   - Admin login: admin@insurance-mlm.com / admin123
   - User login: john@example.com / password

## 📊 Sample Data

The platform includes comprehensive seed data:

### Users
- **Admin**: Full system access and management
- **John Doe**: Network leader with referrals
- **Jane Smith**: John's left leg referral
- **Mike Johnson**: John's right leg referral

### Insurance Packages
- **Car Insurance**: Essential ($89.99) & Premium ($149.99)
- **Health Insurance**: Basic coverage ($199.99)
- **Life Insurance**: Term life protection ($45.99)
- **Home Insurance**: Property protection ($119.99)
- **Travel Insurance**: Trip coverage ($29.99)

## 🎯 User Journeys

### New User Registration
1. Sign up with referral code
2. Browse insurance packages
3. Purchase first policy
4. Generate commissions for referrer
5. Receive referral code to build network

### Network Building
1. Share unique referral code
2. Place referrals in binary tree (left/right)
3. Earn multi-level commissions
4. Track network growth and earnings
5. Advance through rank system

### Claims Process
1. Submit claim with supporting documents
2. Admin reviews and processes
3. Real-time status updates
4. Automatic payouts upon approval

## 🔧 Configuration

### Insurance Package Creation
Admins can create packages with:
- Base premium and coverage amounts
- Required user information fields
- Terms and conditions
- Deductible amounts

### MLM Rank Management
Configure ranks with:
- Achievement requirements
- Monthly salary amounts
- Commission percentage bonuses
- Member benefits

### Commission Algorithm Tuning
Adjust commission rates for:
- Direct referral percentages
- Binary tree level rates
- Rank bonus multipliers
- Premium discount calculations

## 📈 Analytics & Reporting

### Fraud Detection
- Multiple claims pattern analysis
- High-value claim flagging
- User behavior monitoring
- Geographic anomaly detection

### Business Intelligence
- User acquisition metrics
- Commission payout tracking
- Policy performance analysis
- Network growth patterns

### Churn Prediction
- Inactive user identification
- Engagement scoring
- Retention risk assessment
- Intervention recommendations

## 🛡️ Security Considerations

- **Data Encryption**: Sensitive information protection
- **Access Control**: Role-based permissions
- **Audit Trails**: Complete action logging
- **Input Validation**: SQL injection prevention
- **File Security**: Safe document uploads

## 🔮 Advanced Features

### AI Advisor
- Personalized user recommendations
- Network building strategies
- Coverage optimization advice
- Rank advancement guidance

### Premium Discounts
- Daily check-in rewards
- Safety score tracking
- Loyalty program benefits
- Behavioral incentives

### Geospatial Analytics
- Claim location mapping
- Risk area identification
- Regional performance analysis
- Pattern recognition

## 🤝 Contributing

This platform was built with scalability and extensibility in mind. Key areas for enhancement:

1. **Payment Integration**: Stripe/PayPal for premium payments
2. **Mobile App**: React Native or Flutter companion
3. **Real-time Notifications**: WebSocket implementation
4. **Advanced ML**: Sophisticated fraud detection
5. **API Expansion**: Third-party integrations

## 📄 License

Built on Laravel framework under MIT license. Insurance and MLM business logic available for educational and commercial use.

## 🆘 Support

For technical support or business inquiries, contact the development team or refer to the Laravel documentation for framework-specific questions.

---

**Transforming insurance and network marketing through technology** 🚀
