<script>
    export default {
        methods: {
            removeUnderscores(val)
            {
                return val.replace(/_/g, ' ');
            },
            appendCurrency(val)
            {
                return `£ ${val}`;
            },
            appendPercentage(val)
            {
                return `% ${val}`;
            },
            getComparableDate(date)
            {
                if(date)
                {
                    let parts = date.split("-");
                    return new Date(parts[2], parts[1] - 1, parts[0]);
                }
            }
        }
    }
</script>

