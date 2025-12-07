class Validator{
    str='The field must be a valid string';
    email = 'This field accepts only valid emails';
    phone = 'This field accepts only valid phone numbers';
    limit = 8;
    minStr (){
        return 'this field must contains atleast '+this.limit+' characters';
    }

    isStr(data){
        return typeof data === 'string'
    }

    setLimit(limit){
        this.limit = limit;
    }

    hasMinStr(data,limit){
        if(!this.isStr(data)) return false;
        this.limit = limit;
        return data.length >= limit;
    }

    isEmail(data){
        if(!this.isStr(data)) return false;

        return (data.indexOf('@') || data.indexOf('.'))!== -1 ? true : false
    }

    isPhoneNumber(data) {
        const phoneRegex = /^(?:\+?\d{1,3})?[-.\s]?\(?\d{2,4}\)?[-.\s]?\d{3,4}[-.\s]?\d{4}$/;
        return phoneRegex.test(data);
    }
}

export default Validator;