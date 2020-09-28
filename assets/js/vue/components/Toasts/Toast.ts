import Types from './types'

class Toast {
    // Properties

    public id: string;
    public type: string;
    public title: string;
    public body: string;
    public time: Date;
    public delay: number;

    // Constructor

    constructor(id: string, type: string, title: string, body?: string, time?: Date, delay?: number) {
        this.id    = id;
        this.setType(type);
        this.title = title;
        this.body  = body;
        this.time  = time;
        this.delay = delay;
    }

    // Setters

    setType(type: string) {
        this.type = type in Types ? type : 'default';

        return this;
    }

    // Methods

    static make(type: string, title: string, body?: string, time?: Date, delay?: number) {
        const id = Math.random().toString(36).substr(2, 9);

        return new Toast(id, type, title, body, time, delay)
    }
}

export default Toast
