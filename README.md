# Speak Easy Grammar Reference

A searchable English grammar reference portal for Italian-speaking learners.

## Overview

This WordPress plugin provides a comprehensive, searchable English grammar reference library designed specifically for Italian-speaking English learners. It is **not** a course platform, quiz system, or gamified learning platform.

## Features

### 1. **Left Sidebar Navigation**
- Permanent left navigation menu with grammar topics
- Collapsible on mobile devices
- Quick access to all grammar lessons

### 2. **Search System**
- AJAX-powered search functionality
- Searches across:
  - Topic titles
  - Grammar terms
  - Italian explanations
  - English examples
  - Keywords
- Real-time search results

### 3. **Lesson Template**
Each lesson includes:
- Title and CEFR Level
- Italian Explanation
- Grammar Table
- English Examples
- Italian Translations
- Common Mistakes
- Related Topics

### 4. **Responsive Design**
- Desktop: Sidebar left, content right
- Mobile: Hamburger menu with collapsible sidebar
- Optimized for all screen sizes

## Installation

1. Download the plugin files
2. Upload to `/wp-content/plugins/speakeasy-grammar-reference/`
3. Activate the plugin in WordPress admin
4. Access the Grammar Reference admin page

## Usage

### Display the Portal
```
[se-grammar-portal]
```

### Display a Specific Lesson
```
[se-grammar-lesson slug="verb-to-be"]
```

## Database Schema

The plugin creates a custom table `wp_se_grammar_lessons` with the following fields:

- `id` - Unique lesson identifier
- `title` - Lesson title
- `slug` - URL-friendly slug
- `level` - CEFR level (A1, A2, B1, etc.)
- `category` - Grammar category
- `content` - JSON-encoded lesson content
- `keywords` - Search keywords
- `related_topics` - JSON array of related lesson slugs
- `created_at` - Creation timestamp
- `updated_at` - Update timestamp

## Grammar Topics

- Verb To Be
- Subject Pronouns
- Possessive Adjectives
- Articles
- Present Simple
- Present Continuous
- There Is / There Are
- Some / Any
- Countable and Uncountable Nouns
- Prepositions
- Question Forms

## File Structure

```
speakeasy-grammar-reference/
├── speakeasy-grammar-reference.php    # Main plugin file
├── admin/
│   └── admin-page.php                 # Admin interface
├── includes/
│   ├── class-database.php             # Database operations
│   ├── class-lessons.php              # Lesson management
│   ├── class-search.php               # Search functionality
│   └── class-sidebar.php              # Sidebar navigation
├── public/
│   └── public-page.php                # Public frontend
├── templates/
│   ├── lesson-template.php            # Lesson display
│   ├── portal-template.php            # Portal layout
│   ├── sidebar.php                    # Sidebar component
│   └── single-lesson.php              # Single lesson page
├── assets/
│   ├── css/
│   │   └── style.css                  # Stylesheet
│   └── js/
│       └── search.js                  # Search script
└── languages/                         # Translations
```

## Requirements

- WordPress 5.0+
- PHP 7.2+
- MySQL 5.6+

## License

GPL-2.0-or-later

## Contributing

Contributions are welcome! Please follow the existing code style and structure.
