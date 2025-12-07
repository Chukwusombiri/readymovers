<x-app-layout>
    <section class="pb-16 bg-gray-100">
        <div class="mx-auto max-w-5xl my-10 p-6 rounded-lg shadow-lg bg-white">
            <h1 class="text-4xl font-bold text-center mb-6">Cookie Policy</h1>
    
            <p class="mb-4">
                {{config('app.name')}}. ("we", "us", or "our") uses cookies on our website to enhance the user experience and improve
                our services. This Cookie Policy explains what cookies are, how we use them, and your choices regarding
                their use.
            </p>
    
            <h2 class="text-2xl font-semibold mt-8 mb-4">What Are Cookies?</h2>
            <p class="mb-4">
                Cookies are small text files that are placed on your computer or mobile device when you visit a website.
                They allow the website to recognize your device and store certain information, like your preferences or
                previous actions, for a smoother browsing experience.
            </p>
    
            <h2 class="text-2xl font-semibold mt-8 mb-4">How We Use Cookies</h2>
            <p class="mb-4">
                We use both session and persistent cookies to:
            </p>
            <ul class="list-disc list-inside mb-4 space-y-2">
                <li>Enhance website functionality</li>
                <li>Provide a personalized experience</li>
                <li>Analyze how our website is being used</li>
                <li>Deliver targeted advertising based on your preferences</li>
            </ul>
    
            <h2 class="text-2xl font-semibold mt-8 mb-4">Types of Cookies We Use</h2>
            <p class="mb-4">
                We use the following types of cookies on our site:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Essential Cookies</h3>
                    <p>
                        These cookies are necessary for the website to function properly. They ensure basic functionalities
                        and security features.
                    </p>
                </div>
                <div class="bg-green-100 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Performance Cookies</h3>
                    <p>
                        Performance cookies help us understand how visitors interact with the website. They provide
                        information on metrics like traffic and page load times.
                    </p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Functional Cookies</h3>
                    <p>
                        Functional cookies enhance your user experience by remembering your preferences and choices.
                    </p>
                </div>
                <div class="bg-red-100 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Targeting Cookies</h3>
                    <p>
                        Targeting cookies are used to deliver personalized advertisements based on your browsing behavior on
                        our site.
                    </p>
                </div>
                <div class="flex gap-8">                    
                    @cookieconsentbutton(action:'reset', label: __('cookieConsent::cookies.reset'), attributes: ['class' => 'bg-gray-800 text-gray-100 p-4 rounded-2xl shadow-lg text-sm font-semibold tracking-widest hover:bg-opacity-90 cursor-pointer'])
                </div>
            </div>
    
            <h2 class="text-2xl font-semibold mt-8 mb-4">Your Choices Regarding Cookies</h2>
            <p class="mb-4">
                You can control and manage cookies through your browser settings. Please note that if you choose to disable
                cookies, some features of our website may not function properly.
            </p>
    
            <div class="bg-blue-100 p-4 rounded-lg mt-6">
                <p class="text-blue-800">
                    For more detailed information on how to manage cookies in your browser, please visit the browser's help
                    section or consult resources available online.
                </p>
            </div>
    
            <h2 class="text-2xl font-semibold mt-8 mb-4">Changes to This Cookie Policy</h2>
            <p class="mb-4">
                {{config('app.name')}}. reserves the right to update this Cookie Policy at any time. Changes will be posted on this
                page, and we encourage you to review it regularly.
            </p>
    
            <h2 class="text-2xl font-semibold mt-8 mb-4">Contact Us</h2>
            <p>
                If you have any questions or concerns about this Cookie Policy, feel free to <a href="/contact"
                    class="text-blue-600 hover:underline">contact us</a>.
            </p>
        </div>
    </section>    
</x-app-layout>
