# 🚀 Professional Portfolio Website

A modern, fully-functional portfolio website built with cutting-edge web technologies. This portfolio showcases professional design, smooth animations, and exceptional user experience - perfect for impressing top tech companies like Google.

## ✨ Features

### Core Functionality
- **Responsive Design**: Fully responsive across all devices (mobile, tablet, desktop)
- **Dark/Light Theme**: Toggle between dark and light modes with preference saved
- **Smooth Animations**: Engaging scroll animations, typing effects, and transitions
- **Interactive Navigation**: Smart navigation with active section highlighting
- **Contact Form**: Fully functional form with validation
- **Performance Optimized**: Fast loading times with optimized assets

### Advanced Features
- **Particle Animation**: Dynamic background particles in hero section
- **Typing Animation**: Auto-typing text with multiple phrases
- **Progress Bar**: Visual scroll progress indicator
- **Counter Animation**: Animated statistics counters
- **Skill Bars**: Animated skill progress bars
- **Lazy Loading**: Images load as they come into view
- **Custom Cursor**: Enhanced cursor effects (desktop only)
- **Scroll Reveal**: Elements fade in as you scroll
- **Back to Top**: Quick navigation button
- **Accessibility**: WCAG compliant with keyboard navigation

## 🎨 Sections

1. **Hero Section**: Eye-catching introduction with profile image and social links
2. **About Section**: Personal introduction with tech stack and statistics
3. **Skills Section**: Categorized skills with progress bars
4. **Projects Section**: Showcase of featured projects with descriptions
5. **Experience Section**: Timeline of work experience and education
6. **Testimonials**: Client and colleague testimonials
7. **Contact Section**: Contact form and information

## 🛠️ Technologies Used

- **HTML5**: Semantic markup
- **CSS3**: Modern styling with CSS Grid, Flexbox, and animations
- **JavaScript (ES6+)**: Vanilla JS with modern features
- **Font Awesome**: Icons
- **Google Fonts**: Inter & JetBrains Mono

## 📦 Installation & Setup

### Quick Start

1. **Copy your profile image** to the portfolio folder:
   - Add `profile.png` to the portfolio directory
   - Recommended size: 500x500px or larger, square format

2. **Open the portfolio**:
   - Simply open `index.html` in a modern web browser
   - Or use a local server (recommended)

### Using Live Server (Recommended)

```bash
# If you have Python installed:
cd portfolio
python -m http.server 8000

# Then open: http://localhost:8000
```

### Using VS Code Live Server
1. Install "Live Server" extension in VS Code
2. Right-click on `index.html`
3. Select "Open with Live Server"

## 🎯 Customization Guide

### Personal Information

Edit `index.html` and update the following:

1. **Hero Section** (Lines 45-75):
   - Your name
   - Job title/description
   - Social media links

2. **About Section** (Lines 115-180):
   - Personal introduction
   - Technologies you work with
   - Statistics (projects, years, clients)

3. **Skills Section** (Lines 210-330):
   - Add/remove skills
   - Adjust skill percentages

4. **Projects Section** (Lines 350-500):
   - Add your actual projects
   - Update project images
   - Add project links and descriptions

5. **Experience Section** (Lines 520-620):
   - Update work experience
   - Education details
   - Achievements

6. **Contact Section** (Lines 730-800):
   - Email address
   - Phone number
   - Location
   - Social media links

### Styling

Edit `style.css` to customize:

1. **Colors** (Lines 10-25):
   ```css
   --primary-color: #667eea;
   --secondary-color: #764ba2;
   --accent-color: #f093fb;
   ```

2. **Fonts**: Change in the `:root` section
3. **Spacing**: Adjust spacing variables
4. **Animations**: Modify animation speeds and effects

### JavaScript Features

Edit `script.js` to customize:

1. **Typing Animation** (Line 150):
   ```javascript
   this.words = [
       'amazing websites.',
       'your custom text here.',
   ];
   ```

2. **Particle Count** (Line 250): Adjust for performance
3. **Animation Speeds**: Modify timing in various classes

## 🚀 Deployment

### GitHub Pages

1. Create a new repository on GitHub
2. Push your portfolio files:
   ```bash
   git init
   git add .
   git commit -m "Initial portfolio commit"
   git branch -M main
   git remote add origin https://github.com/yourusername/portfolio.git
   git push -u origin main
   ```
3. Go to Settings → Pages
4. Select main branch as source
5. Your site will be live at `https://yourusername.github.io/portfolio`

### Netlify

1. Drag and drop the portfolio folder to [Netlify Drop](https://app.netlify.com/drop)
2. Your site will be live instantly with a custom URL

### Vercel

1. Install Vercel CLI: `npm i -g vercel`
2. Run `vercel` in the portfolio directory
3. Follow the prompts

## 📱 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## 🎓 Best Practices Implemented

### Performance
- Lazy loading images
- Debounced scroll events
- Throttled animations
- Optimized CSS with variables
- Minimal external dependencies

### SEO
- Semantic HTML5 markup
- Meta tags for social sharing
- Proper heading hierarchy
- Alt text for images
- Fast loading times

### Accessibility
- ARIA labels
- Keyboard navigation
- Skip to content link
- Focus indicators
- Sufficient color contrast
- Screen reader friendly

### Code Quality
- Modern ES6+ JavaScript
- Clean, commented code
- Modular architecture
- Consistent naming conventions
- Mobile-first approach

## 📝 Customization Checklist

- [ ] Replace profile images (`profile.png`)
- [ ] Update personal information (name, title, description)
- [ ] Add your social media links
- [ ] Update about section content
- [ ] Add your actual skills and percentages
- [ ] Replace project placeholders with real projects
- [ ] Update work experience and education
- [ ] Add your contact information
- [ ] Customize colors to match your brand
- [ ] Test on multiple devices
- [ ] Optimize images for web
- [ ] Add your favicon
- [ ] Update meta tags for SEO

## 🔧 Troubleshooting

**Images not showing?**
- Ensure `profile.png` is in the portfolio folder
- Check file names match exactly (case-sensitive)
- Verify image file paths in HTML

**Animations not working?**
- Check JavaScript console for errors
- Ensure JavaScript is enabled in browser
- Try hard refresh (Ctrl+Shift+R)

**Theme toggle not working?**
- Clear browser localStorage
- Check browser console for errors

**Form not submitting?**
- Currently shows success message only
- Integrate with backend service (Formspree, EmailJS, etc.) for real submission

## 🌟 Tips for Google-Level Portfolios

1. **Showcase Real Projects**: Include live demos and GitHub links
2. **Write Case Studies**: Explain your problem-solving approach
3. **Show Impact**: Use metrics (improved performance by X%, etc.)
4. **Keep It Updated**: Regular updates with latest projects
5. **Professional Writing**: Proofread all content
6. **Fast Performance**: Aim for 90+ Lighthouse score
7. **Clean Code**: Demonstrate coding best practices
8. **Unique Design**: Make it memorable but professional
9. **Add Blog**: Share technical insights (optional)
10. **GitHub Profile**: Link to well-maintained repositories

## 📧 Support & Contact

For questions or issues:
- GitHub Issues: [Your repo URL]
- Email: ishuv@example.com

## 📄 License

This portfolio template is free to use for personal and commercial projects.

---

**Built with ❤️ by Ishuv Giri**

Good luck with your job applications! 🚀
