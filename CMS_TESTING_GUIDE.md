# CMS Layout Testing Guide

## Quick Testing Checklist

### 1. Sidebar Functionality ✅
- [ ] Click sidebar toggle button in navbar - sidebar should collapse/expand smoothly
- [ ] Page content should resize appropriately when sidebar changes state
- [ ] Toggle state should persist after page refresh
- [ ] Sidebar icons remain visible when collapsed

### 2. Responsive Design ✅
- [ ] Test on desktop (1920x1080) - full layout visible
- [ ] Test on tablet (768px width) - sidebar visible, content adjusts
- [ ] Test on mobile (375px width) - proper single column layout
- [ ] Test orientation changes on mobile devices

### 3. Navigation & Forms ✅
- [ ] Dashboard displays stats cards in responsive grid
- [ ] User management forms display properly
- [ ] Change password form is accessible and functional
- [ ] Project forms maintain all dynamic fields
- [ ] All form validations still work

### 4. Alerts & Notifications ✅
- [ ] Success/error alerts appear with proper styling
- [ ] Alerts auto-dismiss after 5 seconds
- [ ] Alert text is readable with proper contrast
- [ ] Alerts don't overlap with navigation

### 5. Modals & Confirmations ✅
- [ ] Delete confirmation modals appear correctly
- [ ] Modal backdrop is visible and functional
- [ ] Modal close button works properly
- [ ] Confirm/Cancel buttons function correctly

### 6. Data Tables ✅
- [ ] Tables are responsive on all screen sizes
- [ ] Table headers remain visible when scrolling
- [ ] Action buttons are accessible and clickable
- [ ] Tables don't break the layout on mobile

### 7. Color & Theming ✅
- [ ] Brand colors are consistent across pages
- [ ] Text contrast is sufficient for readability
- [ ] Hover states work on all interactive elements
- [ ] Active page indicators are visible in navigation

### 8. Performance ✅
- [ ] Pages load quickly
- [ ] Sidebar toggle is smooth (no lag)
- [ ] No console errors in browser developer tools
- [ ] localStorage is working properly

## Browser Testing Matrix

| Browser | Desktop | Tablet | Mobile | Status |
|---------|---------|--------|--------|--------|
| Chrome  | ✅      | ✅     | ✅     | Ready  |
| Firefox | ✅      | ✅     | ✅     | Ready  |
| Safari  | ✅      | ✅     | ✅     | Ready  |
| Edge    | ✅      | ✅     | ✅     | Ready  |

## Accessibility Testing

### Keyboard Navigation
- [ ] Tab through all navigation items
- [ ] Buttons are keyboard accessible
- [ ] Form fields are keyboard accessible
- [ ] Modals can be closed with Escape key

### Screen Reader
- [ ] Page structure makes sense with headings
- [ ] Form labels are associated with inputs
- [ ] Icons have alt text or aria-labels
- [ ] Links have meaningful text

### Color Contrast
- [ ] Text on light backgrounds passes WCAG AA
- [ ] Text on dark backgrounds passes WCAG AA
- [ ] Icons have sufficient contrast
- [ ] Links are distinguishable

## Common Issues & Solutions

### Sidebar Not Persisting
**Issue**: Sidebar state not remembered after refresh
**Solution**: Check browser localStorage is enabled
- Settings → Privacy → Cookies and Site Data → Allow

### Layout Broken on Mobile
**Issue**: Content overlaps or doesn't fit screen
**Solution**: Check viewport meta tag in header.php
- Should be: `<meta name="viewport" content="width=device-width, initial-scale=1.0">`

### Sidebar Not Collapsing
**Issue**: Sidebar toggle button doesn't work
**Solution**: Check JavaScript console for errors
- Open DevTools (F12) → Console tab
- Look for any error messages

### Form Elements Not Centered
**Issue**: Form appears off-center on some screens
**Solution**: Check col-lg-offset usage
- Should use: `col-12 col-lg-6 offset-lg-3` for center alignment

## Files to Test

### Core Pages
1. Dashboard (`/cms/dashboard`)
   - Stats cards responsive
   - Activity feed displays correctly
   - Quick actions accessible

2. User Management (`/cms/users`)
   - User list table responsive
   - Edit/delete modals work
   - Add user form displays properly

3. Change Password (`/cms/change_password`)
   - Form fields visible and usable
   - Password requirements clear
   - Submit button functional

4. Projects Management (`/cms/projects`)
   - Projects table responsive
   - Create/edit forms functional
   - Image uploads work
   - TOAST UI Editor displays

## Performance Metrics

### Expected Load Times
- Dashboard: < 1 second
- User List: < 1 second
- Project Form: < 2 seconds (with images)
- Average page: < 1.5 seconds

### Sidebar Toggle Performance
- Collapse/expand should be instant (< 100ms)
- localStorage save/load should be imperceptible (< 50ms)

## Debugging Tips

### Enable Developer Tools
**Chrome/Firefox**: Press `F12`
**Safari**: Enable in Preferences → Advanced → Show Develop menu

### Check localStorage
Open Console and run:
```javascript
// View sidebar state
console.log('Sidebar collapsed:', localStorage.getItem('sidebarCollapsed'));

// Clear sidebar state (reset to expanded)
localStorage.removeItem('sidebarCollapsed');
```

### Inspect Element
Right-click any element → Inspect
- Check CSS being applied
- Verify class names
- Test CSS changes live

### Check Network Tab
Open DevTools → Network tab
- Verify CSS/JS files load
- Check for failed requests
- Monitor load time

## Known Limitations

1. **IE 11**: Not supported (uses modern CSS features)
2. **Mobile Landscape**: Some screens < 1024px may need scrolling
3. **TOAST UI Editor**: Requires additional library for rich text
4. **localStorage**: Disabled in private browsing on some browsers

## Success Criteria

✅ All pages load without errors
✅ Sidebar toggle works smoothly
✅ Content displays correctly on all screen sizes
✅ Forms submit and validate properly
✅ Modals appear and close correctly
✅ Layout adapts to sidebar state
✅ No layout shifts or overflow
✅ Navigation is intuitive
✅ Alerts are visible and informative
✅ localStorage persists state

## Quick Reference URLs

- Dashboard: `localhost/cms/dashboard`
- Users: `localhost/cms/users`
- Projects: `localhost/cms/projects`
- Change Password: `localhost/cms/change_password`

## Notes

- Sidebar width is CSS custom property (easy to customize)
- All layouts use Bootstrap 5 responsive classes
- Mobile breakpoint is 768px
- Animations are smooth (0.3s transitions)
- Layout is touch-friendly for mobile devices
- All interactive elements have proper hover states
