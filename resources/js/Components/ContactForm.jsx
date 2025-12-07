import React, { useState } from 'react';

const InputField = ({
    name,
    type = 'text',
    placeholder,
    value,
    onChange,
    error,
    icon,
    label,
    required = true
}) => (
    <div className="space-y-2">
        {label && (
            <label htmlFor={name} className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {label} {required && <span className="text-red-500">*</span>}
            </label>
        )}
        <div className="relative">
            {icon && (
                <div className="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500">
                    {icon}
                </div>
            )}
            {type === 'textarea' ? (
                <textarea
                    id={name}
                    name={name}
                    value={value}
                    onChange={onChange}
                    placeholder={placeholder}
                    required={true}
                    rows="4"
                    className={`
                        w-full px-4 py-3 rounded-xl border transition-all duration-200
                        ${icon ? 'pl-12' : 'pl-4'}
                        ${error
                            ? 'border-red-500 bg-red-50 dark:bg-red-900/20 focus:border-red-500 focus:ring-2 focus:ring-red-200'
                            : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-coral focus:ring-2 focus:ring-coral/20'
                        }
                        text-gray-900 dark:text-white dark:placeholder-gray-400
                        focus:outline-none focus:shadow-lg
                        resize-none
                    `}
                />
            ) : (
                <input
                    id={name}
                    name={name}
                    type={type}
                    value={value}
                    onChange={onChange}
                    placeholder={placeholder}
                    required={true}
                    className={`
                        w-full px-4 py-3 rounded-xl border transition-all duration-200
                        ${icon ? 'pl-12' : 'pl-4'}
                        ${error
                            ? 'border-red-500 bg-red-50 dark:bg-red-900/20 focus:border-red-500 focus:ring-2 focus:ring-red-200'
                            : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-coral focus:ring-2 focus:ring-coral/20'
                        }
                        text-gray-900 dark:text-white dark:placeholder-gray-400
                        focus:outline-none focus:shadow-lg
                    `}
                />
            )}
        </div>
        {error && (
            <div className="flex items-center gap-2 text-sm text-red-600 dark:text-red-400 animate-fadeIn">
                <svg className="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fillRule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clipRule="evenodd" />
                </svg>
                {error}
            </div>
        )}
    </div>
);

const SuccessMessage = ({ message, onClose }) => (
    <div className="fixed top-4 right-4 z-50 animate-slideIn">
        <div className="bg-gradient-to-r from-emerald-500 to-green-500 text-white p-4 rounded-xl shadow-2xl max-w-sm">
            <div className="flex items-center justify-between">
                <div className="flex items-center gap-3">
                    <div className="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p className="font-semibold">Message Sent!</p>
                        <p className="text-sm opacity-90">{message}</p>
                    </div>
                </div>
                <button
                    onClick={onClose}
                    className="text-white/80 hover:text-white"
                    aria-label="Close notification"
                >
                    <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
);

const ErrorMessage = ({ message, onClose }) => (
    <div className="fixed top-4 right-4 z-50 animate-slideIn">
        <div className="bg-gradient-to-r from-red-500 to-rose-500 text-white p-4 rounded-xl shadow-2xl max-w-sm">
            <div className="flex items-center justify-between">
                <div className="flex items-center gap-3">
                    <div className="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p className="font-semibold">Error Occurred</p>
                        <p className="text-sm opacity-90">{message}</p>
                    </div>
                </div>
                <button
                    onClick={onClose}
                    className="text-white/80 hover:text-white"
                    aria-label="Close notification"
                >
                    <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
);

export default function ContactForm() {
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [errorMessages, setErrorMessages] = useState({});
    const [responseMessage, setResponseMessage] = useState('');
    const [showSuccess, setShowSuccess] = useState(false);
    const [showError, setShowError] = useState(false);
    const [formData, setFormData] = useState({
        username: '',
        email: '',
        phone: '',
        subject: '',
        inquiry: ''
    });

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
        // Clear error for this field when user starts typing
        if (errorMessages[e.target.name]) {
            setErrorMessages(prev => ({
                ...prev,
                [e.target.name]: undefined
            }));
        }
    }

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsSubmitting(true);
        setErrorMessages({});

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            const response = await fetch(route('contact.submit'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    setErrorMessages(data.errors);
                } else {
                    throw new Error(data.message || 'Submission failed');
                }
                return;
            }

            // Handle success
            setShowSuccess(true);
            setResponseMessage(data.message || 'Your message has been sent successfully!');
            setFormData({
                username: '',
                email: '',
                phone: '',
                subject: '',
                inquiry: ''
            });

            // Auto-hide success message after 5 seconds
            setTimeout(() => {
                setShowSuccess(false);
                setResponseMessage('');
            }, 5000);

        } catch (error) {
            console.error('Error submitting form:', error);
            setShowError(true);
            setResponseMessage(error.message || 'An error occurred while submitting the form. Please try again later.');

            // Auto-hide error message after 5 seconds
            setTimeout(() => {
                setShowError(false);
                setResponseMessage('');
            }, 5000);
        } finally {
            setIsSubmitting(false);
        }
    }

    const inputFields = [
        {
            name: 'username',
            type: 'text',
            placeholder: 'Your full name',
            label: 'Full Name',
            icon: (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            )
        },
        {
            name: 'email',
            type: 'email',
            placeholder: 'you@example.com',
            label: 'Email Address',
            icon: (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            )
        },
        {
            name: 'phone',
            type: 'tel',
            placeholder: '+44 123 456 7890',
            label: 'Phone Number',
            icon: (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
            )
        },
        {
            name: 'subject',
            type: 'text',
            placeholder: 'How can we help you?',
            label: 'Subject',
            icon: (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
            )
        },
        {
            name: 'inquiry',
            type: 'textarea',
            placeholder: 'Please provide details about your inquiry...',
            label: 'Your Message',
            icon: (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
            )
        }
    ];

    return (
        <>
            {showSuccess && <SuccessMessage message={responseMessage} onClose={() => setShowSuccess(false)} />}
            {showError && <ErrorMessage message={responseMessage} onClose={() => setShowError(false)} />}

            <form onSubmit={handleSubmit} className="space-y-6">
                <div className="grid md:grid-cols-2 gap-6">
                    {inputFields.slice(0, 3).map((field) => (
                        <InputField
                            key={field.name}
                            {...field}
                            value={formData[field.name]}
                            onChange={handleChange}
                            error={errorMessages[field.name]}
                        />
                    ))}
                </div>

                {inputFields.slice(3).map((field) => (
                    <InputField
                        key={field.name}
                        {...field}
                        value={formData[field.name]}
                        onChange={handleChange}
                        error={errorMessages[field.name]}
                    />
                ))}
                <div className='flex justify-end leading-none'>
                    <span className={formData.inquiry.length > 1000 ? 'text-red-500' : 'text-gray-500 dark:text-gray-400'}>
                        {formData.inquiry.length > 1000 ? 'Don\'t exceed 1000 characters'  : formData.inquiry.length+ '/1000 characters'}
                    </span>
                </div>

                {/* Privacy Policy */}
                <div className="flex items-start gap-3 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                    <div className="flex-shrink-0 mt-1">
                        <svg className="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fillRule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p className="text-sm text-gray-600 dark:text-gray-300">
                            By submitting this form, you agree to our{' '}
                            <a href="/privacy-policy" className="text-coral hover:underline font-medium">
                                privacy policy
                            </a>
                            . We respect your privacy and will never share your information.
                        </p>
                    </div>
                </div>

                {/* Submit Button */}
                <div className="pt-4">
                    <button
                        type="submit"
                        disabled={isSubmitting}
                        className={`
                            w-full px-8 py-4 rounded-xl font-semibold text-lg
                            transition-all duration-300 transform hover:scale-[1.02]
                            flex items-center justify-center gap-3
                            ${isSubmitting
                                ? 'bg-gray-400 dark:bg-gray-600 cursor-not-allowed'
                                : 'bg-gradient-to-r from-coral to-orange-500 hover:from-coral/90 hover:to-orange-500/90'
                            }
                            text-white shadow-lg hover:shadow-xl
                            focus:outline-none focus:ring-4 focus:ring-coral/30
                        `}
                    >
                        {isSubmitting ? (
                            <>
                                <svg className="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                    <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                </svg>
                                <span>Processing...</span>
                            </>
                        ) : (
                            <>
                                <span>Send Message</span>
                                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </>
                        )}
                    </button>

                    {/* Character Counter for Message */}
                    <div className="flex justify-center items-center mt-4 text-sm text-gray-500 dark:text-gray-400">
                        <div className="flex items-center gap-2">
                            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>We'll respond within 24 hours</span>
                        </div>
                    </div>
                </div>
            </form>
        </>
    );
}