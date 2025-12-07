const ctx = document.getElementById('donation-bar');

const DONATION_TIERS = [
  {
    label: '1. Maintenir l\'existant',
    amount: 7000
  },
  {
    label: '2. Prévoir les coups dur',
    amount: 3000
  },
  {
    label: '3. De nouveaux projets',
    amount: 5000
  },
]

const DONATION_GOAL = DONATION_TIERS.reduce((acc, tier) => acc + tier.amount, 0);
const DONATION_CURRENT = 2268;

let datasets = []
DONATION_TIERS.forEach((tier) => {
  datasets.push({
    label: tier.label,
    data: [tier.amount],
    fill: false,
    borderWidth: 1,
    categoryPercentage: 1.5,
    barPercentage: 1.0
  })
});
datasets.push({
  label: 'Progression de la collecte',
  data: [0, DONATION_CURRENT],
   fill: false,
  borderWidth: 1,
  categoryPercentage: 0.5,
  barPercentage: 1.0,
});

const labels = ["", ""];
const data = {
  labels: labels,
  datasets: datasets
};

const config = {
  type: 'bar',
  data,
  plugins: [ChartDataLabels],
  options: {
    plugins: {
      datalabels: {
        font: {
          size: 16,
          weight: 'bold',
        },
        padding: {
          top: 5,
        },
        formatter: function(value, ctx) {
          if (value > 0 && ctx.dataIndex == 1) {
            return (value / DONATION_GOAL * 100).toFixed(0) + '%';
          }
          return null;
        }
      },
      tooltip: {
        callbacks: {
          label: function(ctx) {
            let label = ctx.dataset.label || '';
            if (label) {
              label += ': ';
            }
            if (ctx.parsed.x !== null) {
              numberFormatOptions = { style: 'currency', currency: 'EUR', minimumFractionDigits: 0 };
              label += new Intl.NumberFormat('fr-FR', numberFormatOptions).format(ctx.parsed.x);
            }
            return label;
          } 
        }
      },
      legend: {
        onClick: null
      }
    },
    indexAxis: 'y',
    maintainAspectRatio: false,
    responsive: true,
    scales: {
      xAxis: {
        stacked: true,
        ticks: {
          stepSize: DONATION_GOAL / 6,
        },
        min: 0,
        max: DONATION_GOAL,
      },
      yAxis: {
        display: false,
        stacked: true,
      },
      x: {
        display: false,
      },
      y: {
        display: false,
      }
    }
  }
};

new Chart(ctx, config);
