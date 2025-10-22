# DiuGym Website - Simple Code Guide

## 📁 File Structure
```
Index.html          - Main homepage
login.html          - Login page
register.html       - Registration page
assets/
  css/
    style.css       - All styling
    forms.css       - Form styling
  js/
    script.js       - Mobile menu JavaScript
```

## 🎯 Understanding Index.html

### Header Section
```html
<header class="header">
  <div class="logo">💪 DiuGym</div>
  <button class="menu-btn" id="menuBtn">...</button>
  <nav class="nav" id="nav">
    <a href="#home">Home</a>
    ...
  </nav>
</header>
```
- **header**: Fixed navigation bar at top
- **logo**: Company name with icon
- **menu-btn**: Hamburger button (shows on mobile)
- **nav**: Contains all navigation links

### Main Content Sections
Each section follows this simple pattern:
```html
<section id="sectionname" class="section">
  <h2>Section Title</h2>
  <p>Section content...</p>
</section>
```

**Sections:**
1. **Hero** - Big welcome banner
2. **About** - Information about the gym
3. **Classes** - Available workout classes
4. **Trainers** - Meet the team
5. **Pricing** - Membership plans
6. **Testimonials** - Customer reviews
7. **Contact** - Contact form

## 🎨 Understanding style.css

### Structure (organized with comments)
```
1. Reset & Basic Setup
2. Header Styles
3. Sections Styles
4. Cards & Components
5. Mobile Responsive
```

### Key Classes

**Layout:**
- `.header` - Top navigation bar (fixed position)
- `.section` - Standard section padding
- `.alt` - White background (alternates with gray)

**Components:**
- `.logo` - Company logo
- `.nav` - Navigation menu
- `.btn` - Button styling
- `.card` - Content card boxes
- `.hero` - Hero banner with gradient

**Buttons:**
- `.btn` - Standard button (white)
- `.btn-login` - Login button (border style)
- `.btn-signup` - Sign up button (orange/red)

### Colors Used
- **Primary:** #ff6b6b (red/orange)
- **Dark:** #222 (almost black)
- **Light:** #f5f5f5 (light gray)
- **White:** #fff

## ⚡ Understanding script.js

### Simple Mobile Menu Code
```javascript
// 1. Get the menu button and nav elements
const menuBtn = document.getElementById('menuBtn');
const nav = document.getElementById('nav');

// 2. Click button to toggle menu open/close
menuBtn.addEventListener('click', function() {
  nav.classList.toggle('active');
});

// 3. Close menu when clicking a link
nav.querySelectorAll('a').forEach(function(link) {
  link.addEventListener('click', function() {
    nav.classList.remove('active');
  });
});
```

**What it does:**
1. Finds the menu button and navigation
2. When button is clicked, shows/hides the menu
3. Closes menu automatically when you click a link

## 📱 How Mobile Responsive Works

### On Desktop (>768px wide)
- Navigation shows horizontally
- Menu button is hidden
- Full width layout

### On Mobile (<768px wide)
- Menu button appears
- Navigation hides until button clicked
- Stacks vertically
- Single column cards

### CSS Media Query
```css
@media (max-width: 768px) {
  /* Mobile styles here */
}
```

## 🔧 How to Customize

### Change Colors
In `style.css`, find and replace:
- `#ff6b6b` - Main red/orange color
- `#222` - Dark background
- `#f5f5f5` - Light background

### Add New Section
1. Copy an existing section in HTML
2. Change the `id` and content
3. Add navigation link: `<a href="#newsection">New</a>`

### Modify Layout
- Change `.section` padding for spacing
- Adjust `.cards` grid-template-columns for card size
- Modify `.header` padding for header height

## 💡 Tips for Beginners

1. **HTML** = Structure (What's on the page)
2. **CSS** = Style (How it looks)
3. **JavaScript** = Behavior (How it works)

### Common Changes:
- **Text:** Edit directly in HTML
- **Colors:** Change in CSS
- **Layout:** Adjust CSS padding, margin, grid
- **Functionality:** Modify JavaScript

### Testing:
1. Save your changes
2. Refresh browser (Ctrl+F5 or Cmd+Shift+R)
3. Check mobile view (browser dev tools F12)

## 📚 Learn More

- [HTML Basics](https://developer.mozilla.org/en-US/docs/Learn/HTML)
- [CSS Flexbox](https://css-tricks.com/snippets/css/a-guide-to-flexbox/)
- [CSS Grid](https://css-tricks.com/snippets/css/complete-guide-grid/)
- [JavaScript Events](https://developer.mozilla.org/en-US/docs/Web/Events)
