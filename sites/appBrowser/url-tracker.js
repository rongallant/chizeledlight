// This script will be injected into iframe pages to track navigation
(function() {
    // Send URL changes to parent window
    function sendUrlToParent() {
        const currentPath = window.location.pathname;
        const search = window.location.search;
        const hash = window.location.hash;
        const fullPath = currentPath + search + hash;
        
        // Send message to parent window with current URL
        window.parent.postMessage({
            type: 'urlChange',
            url: fullPath,
            title: document.title
        }, '*');
    }
    
    // Monitor URL changes
    let lastUrl = window.location.href;
    
    // Check for URL changes every 100ms
    setInterval(() => {
        if (window.location.href !== lastUrl) {
            lastUrl = window.location.href;
            sendUrlToParent();
        }
    }, 100);
    
    // Also monitor popstate for back/forward navigation
    window.addEventListener('popstate', sendUrlToParent);
    
    // Send initial URL
    sendUrlToParent();
})();
