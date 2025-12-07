const fetchAddress = async (postcode, field, sisterField, onSuccess, onFail) => {
    if (postcode.length < 5) {
        onFail(field, sisterField, 'Post-code must be atleast 5 characters')
        return;
    } // Prevents unnecessary API calls

    try {
        const response = await fetch(`https://api.postcodes.io/postcodes/${postcode}`);
        const data = await response.json();

        if (data.status === 200) {
            const address = `${data.result.admin_district}, ${data.result.region}, ${data.result.country}`;
            onSuccess(address, [data.result.longitude, data.result.latitude], field, sisterField);
        } else {
            onFail(field, sisterField, 'invalid postcode');
        }
    } catch (error) {
        console.error('Error fetching address:', error);
    }
};

export default fetchAddress