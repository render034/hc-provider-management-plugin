/**
 * Main frontend JavaScript for HC Provider Management Plugin
 */

// Import styles
import '../scss/main.scss';

// Main plugin functionality
class HCProviderManagement {
    constructor() {
        this.init();
    }

    init() {
        console.log('HC Provider Management Plugin loaded');

        // Initialize components when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                this.initComponents();
            });
        } else {
            this.initComponents();
        }
    }

    initComponents() {
        // Initialize plugin components here
        this.initLocations();
        this.initProviders();
        this.initFaqs();
    }

    initLocations() {
        // Location-specific functionality
    }

    initProviders() {
        // Provider-specific functionality
    }

    initFaqs() {
        // FAQ-specific functionality
    }
}

// Initialize the plugin
new HCProviderManagement();