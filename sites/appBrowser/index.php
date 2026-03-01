<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chizeledlight Sites</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Sidebar with Site List -->
    <div class="sidebar">
        <div class="p-6 border-bottom border-gray-700">
            <h1 class="text-xl font-bold text-blue-400">Chizeledlight Sites</h1>
            <p class="text-xs text-gray-400 mt-1">Sites by Ron Gallant</p>
        </div>
        <div id="site-list" class="flex-grow overflow-y-auto">
            <!-- Sites will be injected here -->
        </div>
        <div class="p-4 text-[10px] text-gray-500 border-t border-gray-700 text-center">
            &copy; 1996-2002 Retro Explorer
        </div>
    </div>

    <!-- Main Browser Area -->
    <div class="browser-container">
        <div class="netscape-3 outset">
            
            <!-- Window Title Bar -->
            <div class="title-bar">
                <div class="flex items-center gap-2">
                    <span class="text-sm">Netscape: <span id="window-title">Welcome to the Internet</span></span>
                </div>
                <div class="flex gap-1">
                    <button class="w-4 h-4 bg-gray-300 text-black outset text-[8px] flex items-center justify-center">_</button>
                    <button class="w-4 h-4 bg-gray-300 text-black outset text-[8px] flex items-center justify-center">□</button>
                    <button class="w-4 h-4 bg-gray-300 text-black outset text-[8px] flex items-center justify-center">X</button>
                </div>
            </div>

            <!-- Menu Bar -->
            <div class="menu-bar netscape-font">
                <span><u>F</u>ile</span>
                <span><u>E</u>dit</span>
                <span><u>V</u>iew</span>
                <span><u>G</u>o</span>
                <span><u>B</u>ookmarks</span>
                <span><u>O</u>ptions</span>
                <span><u>D</u>irectory</span>
                <span><u>W</u>indow</span>
                <span><u>H</u>elp</span>
            </div>

            <!-- Main Toolbar -->
            <div class="toolbar">
                <div class="nav-button outset" id="btn-back">
                    <span class="nav-icon">⬅️</span>
                    <span class="netscape-font">Back</span>
                </div>
                <div class="nav-button outset" id="btn-forward">
                    <span class="nav-icon">➡️</span>
                    <span class="netscape-font">Forward</span>
                </div>
                <div class="nav-button outset" id="btn-home">
                    <span class="nav-icon">🏠</span>
                    <span class="netscape-font">Home</span>
                </div>
                <div class="nav-button outset" id="btn-reload">
                    <span class="nav-icon">🔄</span>
                    <span class="netscape-font">Reload</span>
                </div>
                <div class="nav-button outset">
                    <span class="nav-icon">🖼️</span>
                    <span class="netscape-font">Images</span>
                </div>
                <div class="nav-button outset">
                    <span class="nav-icon">📂</span>
                    <span class="netscape-font">Open</span>
                </div>
                <div class="nav-button outset">
                    <span class="nav-icon">🖨️</span>
                    <span class="netscape-font">Print</span>
                </div>
                <div class="nav-button outset">
                    <span class="nav-icon">🔍</span>
                    <span class="netscape-font">Find</span>
                </div>
                <div class="nav-button outset" style="color: red;">
                    <span class="nav-icon">🛑</span>
                    <span class="netscape-font">Stop</span>
                </div>

                <!-- Netscape "N" Logo with animation -->
                <div class="ns-logo" id="loading-logo">
                    <div class="stars" id="star-container"></div>
                    <span class="ns-logo-n">N</span>
                </div>
            </div>

            <!-- URL / Location Bar -->
            <div class="url-bar-row netscape-font">
                <div class="flex gap-1">
                    <div class="px-2 py-0.5 outset bg-[#c0c0c0]">What's New?</div>
                    <div class="px-2 py-0.5 outset bg-[#c0c0c0]">What's Cool?</div>
                    <div class="px-2 py-0.5 outset bg-[#c0c0c0]">Destinations</div>
                </div>
                <div class="flex items-center gap-2 flex-grow ml-4">
                    <span>Location:</span>
                    <div class="inset url-input" id="current-url">about:blank</div>
                </div>
            </div>

            <!-- Viewport -->
            <div class="iframe-viewport inset">
                <iframe id="browser-frame" src="about:blank"></iframe>
            </div>

            <!-- Status Bar -->
            <div class="status-bar netscape-font">
                <div class="status-section inset flex-grow" id="status-text">Document: Done</div>
                <div class="status-section inset w-32 justify-center" id="loading-status">
                    <div class="loading-bar" id="ui-loading-bar">
                        <div class="loading-progress"></div>
                    </div>
                </div>
                <div class="status-section inset w-12 justify-center">
                    <span id="security-icon" title="Security restricted due to cross-origin policy">🔒</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        let sites = [];
        let currentSite = null;

        // Load sites from JSON file
        fetch('sites.json')
            .then(response => response.json())
            .then(data => {
                sites = data;
                initializeApp();
            })
            .catch(error => {
                console.error('Error loading sites:', error);
            });

        function initializeApp() {
            const siteListEl = document.getElementById('site-list');
            const browserFrame = document.getElementById('browser-frame');
            const currentUrlEl = document.getElementById('current-url');
            const windowTitleEl = document.getElementById('window-title');
            const statusTextEl = document.getElementById('status-text');
            const loadingBarEl = document.getElementById('ui-loading-bar');
            const starContainer = document.getElementById('star-container');

            // Nav Buttons
            const btnBack = document.getElementById('btn-back');
            const btnForward = document.getElementById('btn-forward');
            const btnHome = document.getElementById('btn-home');
            const btnReload = document.getElementById('btn-reload');

            // Initialize Site List
            let defaultSiteElement = null;
            
            // Sort sites alphabetically by name (case-insensitive)
            const sortedSites = sites.sort((a, b) => a.name.toLowerCase().localeCompare(b.name.toLowerCase()));
            
            sortedSites.forEach(site => {
                const div = document.createElement('div');
                div.className = 'site-item';
                div.innerHTML = `
                    <div class="font-bold">${site.name}</div>
                    <div class="text-xs opacity-60">${site.description}</div>
                `;
                div.onclick = () => loadSite(site, div);
                siteListEl.appendChild(div);
                
                // Store reference to default site
                if (site.id === 'default') {
                    defaultSiteElement = { element: div, site: site };
                }
            });

            // Auto-load the welcome page
            if (defaultSiteElement) {
                loadSite(defaultSiteElement.site, defaultSiteElement.element);
            }

            // Create stars for the animation
            for (let i = 0; i < 15; i++) {
                createStar();
            }

            // Setup Navigation Listeners
            btnReload.onclick = reloadFrame;
            btnHome.onclick = goHome;
            btnBack.onclick = crossOriginWarning;
            btnForward.onclick = crossOriginWarning;

            // Listen for URL changes from iframe
            window.addEventListener('message', (event) => {
                if (event.data && event.data.type === 'urlChange') {
                    const fakeDomain = browserFrame.getAttribute('data-fake-domain');
                    const receivedUrl = event.data.url;
                    
                    console.log('Received URL change message:', receivedUrl);
                    
                    // Check if this is an external domain
                    if (receivedUrl.startsWith('http://') || receivedUrl.startsWith('https://')) {
                        try {
                            const url = new URL(receivedUrl);
                            const isExternal = !url.hostname.includes('localhost') && !url.hostname.includes('127.0.0.1');
                            
                            if (isExternal) {
                                // This is an external domain - show the real URL
                                currentUrlEl.innerText = receivedUrl;
                                windowTitleEl.innerText = event.data.title || receivedUrl;
                                statusTextEl.innerText = `Document: Done (External Site)`;
                                return;
                            }
                        } catch (e) {
                            console.log('Error parsing URL:', e);
                        }
                    }
                    
                    if (fakeDomain) {
                        // Extract relative path from the full URL
                        let relativePath = '';
                        
                        // Parse the URL to get the path after /sites/sitename/
                        if (receivedUrl.includes('/sites/')) {
                            const urlParts = receivedUrl.split('/sites/');
                            if (urlParts.length > 1) {
                                const afterSites = urlParts[1];
                                const pathParts = afterSites.split('/');
                                // Remove the first part (site name) and keep the rest
                                if (pathParts.length > 1) {
                                    relativePath = pathParts.slice(1).join('/');
                                }
                            }
                        }
                        
                        const displayUrl = relativePath ? 
                            `http://${fakeDomain}/${relativePath}` : 
                            `http://${fakeDomain}`;
                        
                        console.log('Parsed URL:', {
                            receivedUrl,
                            relativePath,
                            displayUrl
                        });
                        
                        currentUrlEl.innerText = displayUrl;
                        windowTitleEl.innerText = event.data.title || windowTitleEl.innerText;
                    }
                }
            });

            function createStar() {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.left = Math.random() * 100 + '%';
                star.style.animationDelay = Math.random() * 2 + 's';
                starContainer.appendChild(star);
            }

            function applyBrowserResolution(resolution) {
                const [width, height] = resolution.split('x').map(Number);
                const netscapeWindow = document.querySelector('.netscape-3.outset');
                const viewport = document.querySelector('.iframe-viewport');
                
                if (netscapeWindow && viewport) {
                    // Calculate scale factor to fit the resolution in the available space
                    const maxWidth = netscapeWindow.parentElement.clientWidth - 40; // Leave some margin
                    const maxHeight = window.innerHeight - 200; // Leave room for UI elements
                    
                    const scaleX = maxWidth / width;
                    const scaleY = maxHeight / height;
                    const scale = Math.min(scaleX, scaleY, 1); // Don't scale up, only down
                    
                    const actualWidth = width * scale;
                    const actualHeight = height * scale;
                    
                    // Apply the size and center the browser window
                    netscapeWindow.style.width = actualWidth + 'px';
                    netscapeWindow.style.height = actualHeight + 'px';
                    netscapeWindow.style.margin = '20px auto';
                    netscapeWindow.style.transform = ''; // Remove transform since we're setting actual size
                    netscapeWindow.style.transformOrigin = '';
                    
                    // Update viewport size
                    viewport.style.height = (actualHeight - 180) + 'px'; // Subtract browser chrome height
                    
                    console.log(`Applied resolution ${resolution} at scale ${scale.toFixed(2)} (actual: ${actualWidth}x${actualHeight})`);
                }
            }

            function resetBrowserSize() {
                const netscapeWindow = document.querySelector('.netscape-3.outset');
                const viewport = document.querySelector('.iframe-viewport');
                
                if (netscapeWindow && viewport) {
                    // Reset to default full-size
                    netscapeWindow.style.width = '';
                    netscapeWindow.style.height = '';
                    netscapeWindow.style.margin = '';
                    netscapeWindow.style.transform = '';
                    netscapeWindow.style.transformOrigin = '';
                    
                    // Reset viewport to default height
                    viewport.style.height = '';
                    
                    console.log('Reset browser to default size');
                }
            }

            function loadSite(site, element) {
                currentSite = site;
                // Update active state in sidebar
                document.querySelectorAll('.site-item').forEach(el => el.classList.remove('active'));
                element.classList.add('active');

                // Use fakeDomain for display, actual URL for loading
                const displayUrl = site.fakeDomain ? `http://${site.fakeDomain}` : site.url;
                
                // UI Feedback
                statusTextEl.innerText = `Connect: Contacting ${displayUrl}...`;
                loadingBarEl.style.display = 'block';
                currentUrlEl.innerText = displayUrl;
                windowTitleEl.innerText = site.name;

                // Store base URL for this site
                browserFrame.setAttribute('data-base-url', site.url);
                browserFrame.setAttribute('data-fake-domain', site.fakeDomain || '');

                // Apply browser resolution if specified
                if (site.resolution) {
                    applyBrowserResolution(site.resolution);
                } else {
                    resetBrowserSize();
                }

                // Load iframe with actual URL
                browserFrame.src = site.url;

                // Handle load completion and inject URL tracker
                browserFrame.onload = () => {
                    statusTextEl.innerText = "Document: Done";
                    loadingBarEl.style.display = 'none';
                    
                    // Inject URL tracker script into iframe
                    try {
                        const iframeDoc = browserFrame.contentDocument || browserFrame.contentWindow.document;
                        
                        const script = iframeDoc.createElement('script');
                        script.textContent = `
                            (function() {
                                function sendUrlToParent() {
                                    const currentPath = window.location.pathname;
                                    const search = window.location.search;
                                    const hash = window.location.hash;
                                    const fullPath = currentPath + search + hash;
                                    
                                    window.parent.postMessage({
                                        type: 'urlChange',
                                        url: fullPath,
                                        title: document.title
                                    }, '*');
                                }
                                
                                let lastUrl = window.location.href;
                                setInterval(() => {
                                    if (window.location.href !== lastUrl) {
                                        lastUrl = window.location.href;
                                        sendUrlToParent();
                                    }
                                }, 100);
                                
                                window.addEventListener('popstate', sendUrlToParent);
                                sendUrlToParent();
                            })();
                        `;
                        iframeDoc.head.appendChild(script);
                    } catch (e) {
                        console.log('Cannot inject script due to cross-origin restrictions:', e);
                    }
                };
            }

            // Cross-Origin safe reload: re-assigning SRC instead of using contentWindow.location.reload()
            function reloadFrame() {
                if (!browserFrame.src || browserFrame.src === 'about:blank') return;
                
                const currentSrc = browserFrame.src;
                browserFrame.src = 'about:blank'; // Brief reset to trigger reload animation if needed
                
                statusTextEl.innerText = "Reloading document...";
                loadingBarEl.style.display = 'block';
                
                setTimeout(() => {
                    browserFrame.src = currentSrc;
                }, 50);
            }

            function goHome() {
                // Find and load the welcome site
                const welcomeSite = sites.find(site => site.id === 'default');
                if (welcomeSite) {
                    // Find the welcome site element in the sidebar
                    const welcomeElement = Array.from(document.querySelectorAll('.site-item')).find(el => 
                        el.querySelector('.font-bold').textContent === welcomeSite.name
                    );
                    
                    if (welcomeElement) {
                        loadSite(welcomeSite, welcomeElement);
                    }
                }
            }

            // Monitor iframe URL changes
            setInterval(() => {
                if (currentSite && browserFrame.src !== browserFrame.getAttribute('data-last-src')) {
                    browserFrame.setAttribute('data-last-src', browserFrame.src);
                    updateDisplayedUrl();
                }
            }, 100);

            // Modern browsers block programatic "Back" navigation for cross-origin iframes
            function crossOriginWarning() {
                statusTextEl.innerText = "Error: History navigation blocked by modern browser cross-origin policy.";
                setTimeout(() => {
                    statusTextEl.innerText = "Document: Done";
                }, 3000);
            }
        }
    </script>
</body>
</html>