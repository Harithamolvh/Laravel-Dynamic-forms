
    function formBuilder() {
        return {
            form: {
                name: '',
                slug: '',
                description: '',
                fields: []
            },
            showPreview: false,
            fieldCounter: 0,

            addField() {
                this.fieldCounter++;
                this.form.fields.push({
                    id: this.fieldCounter,
                    label: '',
                    name: '',
                    type: '',
                    options: [],
                    rules: {
                        required: false,
                        min_length: '',
                        max_length: '',
                        min: '',
                        max: ''
                    },
                    order: this.form.fields.length
                });
            },

            removeField(index) {
                this.form.fields.splice(index, 1);
            },

            generateSlug() {
                this.form.slug = this.form.name
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            },

            generateFieldName(index) {
                const field = this.form.fields[index];
                field.name = field.label
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '_')
                    .replace(/^_+|_+$/g, '');
            },

            updateFieldType(index) {
                const field = this.form.fields[index];
                if (['select', 'radio', 'checkbox'].includes(field.type)) {
                    if (field.options.length === 0) {
                        field.options = [{
                            value: '',
                            label: ''
                        }];
                    }
                } else {
                    field.options = [];
                }
            },

            addOption(fieldIndex) {
                this.form.fields[fieldIndex].options.push({
                    value: '',
                    label: ''
                });
            },

            removeOption(fieldIndex, optionIndex) {
                this.form.fields[fieldIndex].options.splice(optionIndex, 1);
            },

            previewForm() {
                this.showPreview = true;
            },

            submitForm() {
                // Prepare the data for submission
                const formData = {
                    name: this.form.name,
                    slug: this.form.slug,
                    description: this.form.description,
                    fields: this.form.fields.map(field => ({
                        label: field.label,
                        name: field.name,
                        type: field.type,
                        options: field.options.length > 0 ? field.options : null,
                        rules: this.cleanRules(field.rules),
                        order: field.order
                    }))
                };

                // Log the data (replace with actual API call)
                console.log('Form Data:', JSON.stringify(formData, null, 2));

                // Here you would typically send this data to your Laravel backend
                // fetch('/api/forms', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                //     },
                //     body: JSON.stringify(formData)
                // });

                alert('Form structure created! Check console for JSON output.');
            },

            cleanRules(rules) {
                const cleaned = {};
                Object.keys(rules).forEach(key => {
                    if (rules[key] !== '' && rules[key] !== false) {
                        cleaned[key] = rules[key];
                    }
                });
                return Object.keys(cleaned).length > 0 ? cleaned : null;
            }
        }
    }
