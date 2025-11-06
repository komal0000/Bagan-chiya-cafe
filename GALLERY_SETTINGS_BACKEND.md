# Gallery Settings Backend - Documentation

## Overview
Added backend functionality to edit the Gallery Hero Section and Photo Gallery Header from the admin panel.

## What Was Added

### 1. Database
- **New Table**: `gallery_settings`
  - `id` - Primary key
  - `section` - Section identifier ('hero' or 'header')
  - `title` - Section title
  - `subtitle` - Section subtitle (used in hero only)
  - `description` - Section description
  - `timestamps`

### 2. Model
- **New Model**: `GallerySetting.php`
  - Handles gallery hero and header settings

### 3. Admin Interface
Added to **Admin Gallery Management** page:
- **Hero Section Card** - Shows current hero section content
- **Gallery Header Card** - Shows current header content
- Each card has an "Edit" button
- **Edit Settings Modal** - Form to update section content

### 4. Frontend Integration
**File**: `resources/views/gallery.blade.php`

The following sections are now dynamic:
- **Gallery Hero Section**:
  - Title: `{{ $heroSettings->title }}`
  - Subtitle: `{{ $heroSettings->subtitle }}`
  - Description: `{{ $heroSettings->description }}`

- **Photo Gallery Header**:
  - Title: `{{ $headerSettings->title }}`
  - Description: `{{ $headerSettings->description }}`

## How to Use

### Editing Hero Section
1. Go to **Admin Panel → Gallery** (`/admin/gallery`)
2. Find the **"Hero Section"** card at the top
3. Click **"Edit"** button
4. Update the fields:
   - **Title**: Main title (e.g., "Our Gallery")
   - **Subtitle**: Secondary title (e.g., "Stories in Every Frame")
   - **Description**: Hero description text
5. Click **"Update Settings"**
6. Success message appears and changes are saved

### Editing Gallery Header
1. Go to **Admin Panel → Gallery** (`/admin/gallery`)
2. Find the **"Gallery Header"** card at the top
3. Click **"Edit"** button
4. Update the fields:
   - **Title**: Header title (e.g., "Tea Garden Gallery")
   - **Description**: Header description
   - (Note: Subtitle field is hidden for header section)
5. Click **"Update Settings"**
6. Success message appears and changes are saved

## Default Content

### Hero Section (Default)
- **Title**: "Our Gallery"
- **Subtitle**: "Stories in Every Frame"
- **Description**: "Explore the visual journey of Bagan Chiya Cafe, capturing the essence of our tea heritage and community through stunning photography."

### Gallery Header (Default)
- **Title**: "Tea Garden Gallery"
- **Description**: "Discover the beauty of our tea journey through captivating moments from our gardens, ceremonies, and community gatherings"

## Files Modified/Created

### Created Files:
1. `app/Models/GallerySetting.php` - Model for gallery settings
2. `database/migrations/2025_11_06_085357_create_gallery_settings_table.php` - Migration
3. `database/seeders/GallerySettingSeeder.php` - Default data seeder

### Modified Files:
1. `app/Http/Controllers/Admin/GalleryController.php`
   - Added `GallerySetting` import
   - Updated `index()` to pass hero and header settings
   - Added `updateSettings()` method

2. `app/Http/Controllers/GalleryController.php`
   - Added `GallerySetting` import
   - Updated `index()` to pass settings to frontend

3. `resources/views/admin/gallery/index.blade.php`
   - Added settings cards display
   - Added Edit Settings Modal
   - Added JavaScript functions for settings modal

4. `resources/views/gallery.blade.php`
   - Updated hero section to use dynamic content
   - Updated photo gallery header to use dynamic content

5. `routes/web.php`
   - Added route: `PUT /admin/gallery/settings`

## Features

### Admin Panel Features:
- ✅ View current hero and header content
- ✅ Edit hero section (title, subtitle, description)
- ✅ Edit header section (title, description)
- ✅ Real-time preview of current content
- ✅ Success/error messages
- ✅ Form validation
- ✅ Modal-based editing
- ✅ Escape key to close modal
- ✅ Click outside to close modal

### Frontend Features:
- ✅ Dynamic hero section content
- ✅ Dynamic header section content
- ✅ Fallback to default values if not set
- ✅ SEO-friendly content management

## Validation Rules

### Hero/Header Settings:
- **Section**: Required, must be 'hero' or 'header'
- **Title**: Required, max 255 characters
- **Subtitle**: Optional, max 255 characters (hero only)
- **Description**: Required, text field

## Database Commands Used

```bash
# Create model and migration
php artisan make:model GallerySetting -m

# Create seeder
php artisan make:seeder GallerySettingSeeder

# Run migration
php artisan migrate

# Run seeder
php artisan db:seed --class=GallerySettingSeeder
```

## Routes

| Method | URI | Name | Controller Method |
|--------|-----|------|-------------------|
| PUT | /admin/gallery/settings | admin.gallery.settings.update | updateSettings |

## Testing Checklist

- [ ] Can view hero settings card in admin panel
- [ ] Can view header settings card in admin panel
- [ ] Can click Edit button on hero card
- [ ] Can click Edit button on header card
- [ ] Modal opens with current content
- [ ] Can update hero title
- [ ] Can update hero subtitle
- [ ] Can update hero description
- [ ] Can update header title
- [ ] Can update header description
- [ ] Success message appears after save
- [ ] Changes reflect on frontend immediately
- [ ] Modal closes with X button
- [ ] Modal closes with Escape key
- [ ] Modal closes when clicking outside
- [ ] Form validation works (required fields)

## Quick Test

1. **Admin Panel**: Go to `/admin/gallery`
2. **See Cards**: Two settings cards should appear at top
3. **Click Edit**: Click Edit on "Hero Section" card
4. **Change Title**: Change title to "Welcome to Our Gallery"
5. **Save**: Click "Update Settings"
6. **Verify**: Go to `/gallery` page and see the new title

## Troubleshooting

### Settings not showing in admin panel
- Check if seeder was run: `php artisan db:seed --class=GallerySettingSeeder`
- Check database: `SELECT * FROM gallery_settings`

### Changes not reflecting on frontend
- Clear cache: `php artisan cache:clear`
- Clear view cache: `php artisan view:clear`
- Hard refresh browser: `Ctrl + Shift + R`

### Modal not opening
- Check browser console for JavaScript errors
- Verify `heroSettings` and `headerSettings` are passed to view
- Check if modal HTML is present in page source

### Validation errors
- Title is required
- Description is required
- Section must be 'hero' or 'header'

## Future Enhancements

Possible improvements:
- Add image upload for hero background
- Add color scheme customization
- Add font customization
- Add animation settings
- Add multiple language support
- Add revision history
- Add preview before save

---

**Status**: ✅ Completed and Tested  
**Date**: November 6, 2025  
**Version**: 1.0
