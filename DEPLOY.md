# Deployment Guide

## Manual Deploy Button

This plugin has a manual deployment workflow that deploys to the production server.

### How to Deploy

1. Go to the GitHub repository
2. Click on the **Actions** tab
3. Select **Deploy Plugin** from the left sidebar
4. Click the **Run workflow** button (on the right)
5. Type `deploy` in the confirmation field
6. Click **Run workflow**

The workflow will:
- Build the plugin assets (runs `npm install` and `npm run build`)
- Deploy files to the production server via FTP
- Exclude development files (node_modules, .git, package files, etc.)

### Production Server Details

- **Server**: 107.180.40.145
- **Path**: `/wp-content/plugins/hc-provider-management-plugin/`
- **Method**: FTP

### First Time Setup

Before your first deployment, you need to add the FTP password to GitHub Secrets:

1. Go to repository Settings → Secrets and variables → Actions
2. Click **New repository secret**
3. Name: `FTP_PASSWORD`
4. Value: `[Your FTP password]`
5. Click **Add secret**

### Notes

- The deployment requires typing "deploy" as confirmation to prevent accidental deploys
- The server path can be updated in `.github/workflows/deploy.yml` if needed
- Only built/compiled files are deployed (excludes source files and dependencies)
